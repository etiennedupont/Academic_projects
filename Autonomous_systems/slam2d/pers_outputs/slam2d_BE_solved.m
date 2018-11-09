
% SLAM2D  A 2D EKF-SLAM algorithm with simulation and graphics.

% I. INITIALIZE ===========================================================

% I.1 SIMULATOR -----------------------------------------------------------

init_simulator

% I.2 ESTIMATOR -----------------------------------------------------------

% a. Define Map: Gaussian {x,P}
%   mapsize: size of the map
mapsize = 75; % Minimum mapsize -> 5 / Maximum mapsize = #landmarks*2+3
%   x: state vector's mean
x = zeros(mapsize,1);
%   P: state vector's covariances matrix
P = zeros(mapsize,mapsize);

% b. Define system noise: Gaussian {0,Q}
q = [2e-2,2e-2];      % amplitude or standard deviation
Q = diag(q.^2); % covariance matrix, built from the standard deviation

% c. Define measurement noise: Gaussian {0,S}
s = [.1;1*pi/180];      % amplitude or standard deviation
%s = [5e-4;1e-5]
S = diag(s.^2); % covariance matrix, built from the standard deviation

% d. Map management
init_map_management(mapsize); % See Help Note #12 above.

% e. Landmarks management
init_landmark_management;     % See Help Note #12 above.

% f. Initialize robot in map
% query for map space 
r = mm_query_space(3); % get pointers to robot space in the map.
mm_block_space(r);     % block map positions

% init mean and covariance
x_ini = [-0.5;0;0];
%x_ini = 0;
x(r)   = x_ini + sim_get_initial_robot_pose();    % initialize robot state.
P(r,r) = zeros(3,3);    % initialize robot covariance
%P(r,r) = diag([1e-2,1e-2,1e-2])

% I.3 GRAPHICS ------------------------------------------------------------

init_graphics





% II. TEMPORAL LOOP =======================================================

for t = 1:200
    
    
    % II.1 SIMULATOR ------------------------------------------------------
    
    sim_simulate_one_step();
    
    % II.2 ESTIMATOR ------------------------------------------------------
    
    % a. create useful map pointers to be used hereafter
    %-----------------------------------------------------
    % vector with all pointers to known landmarks
    m  = lm_all_lmk_pointers(); 
    % vector with pointers to all used states: robot and known landmarks
    rm = [r,m];
    
    
    % b. Prediction -- robot motion
    %-------------------------------
    
    % Update {x(r), P}: using the function move(),
    %   compute new robot position x(r),
    %   and obtain Jacobians R_r, R_n.
    [x(r), R_r, R_n] = move(x(r),sim_get_control_signal());
    % Then update covariances matrix P --> use sparse formulation, e.g.:
    P(r,m) = R_r*P(r,m);
    P(m,r) = P(r,m)';
    P(r,r) = R_r*P(r,r)*R_r'+R_n*Q*R_n';
    
    
    % c. Landmark correction -- known landmarks
    %-------------------------------------------
    
    % c1. obtain all indices of existing landmarks
    lids = lm_all_lmk_ids(); 
    
    % c2. loop for all known landmarks
    for i = lids
        
        % c3. Obtain pointers to landmark 'i'
        l = lm_lmk_pointer(i) ; % landmark's pointers vector
        
        % c4. compute expectation Gaussian {e,E}  --- this is h(x) in your
        % notes
        [e, E_r, E_l] = observe(x(r),x(l));
        E = E_r*P(r,r)*E_r'+E_r*P(r,l)*E_l'+E_l*P(l,r)*E_r'+E_l*P(l,l)*E_l';
        
        % c5. get measurement Yi for landmark 'i', as Yi=[dist,angle]'
        Yi = sim_get_lmk_measurement(i);
        
        % c6. compute innovation --- this is y-h(x), or y-e as we have
        % e=h(x)
        z = Yi-e;
        % bring angular innovations z(2) around zero, and not multiples of
        % 2pi !
        if z(2) > pi
            z(2) = z(2) - 2*pi;
        end
        if z(2) < -pi
            z(2) = z(2) + 2*pi;
        end
        
        % c7. compute innovation covariance
        Z = E+S;
        
        % Mahalanobis test
        if z' * Z^-1 * z < 9
            
            % c8. compute Kalman gain^
            K = [P(r,r)*E_r'+P(r,l)*E_l';P(m,r)*E_r'+P(m,l)*E_l']*Z^-1;
            
            % c9. Perform Kalman update
            x(rm)    = x(rm)+K*z;
            P(rm,rm) = P(rm,rm)-K*Z*K';
            
        end % Mahalanobis test
        
    end % loop for all known landmarks
    
    
    
    % d. Landmark Initialization -- one new landmark only at each iteration
    %----------------------------------------------------------------------
    
    % d1. Get ID of a non-mapped landmark
    i = lm_find_non_mapped_lmk();
    if ~isempty(i)
        % d2. Get pointers vector of the new landmark in the map
        l = mm_query_space(2);  
        
        % if there is still space for a new landmark in the map
        if numel(l) >= 2
            
            % d3. block map space
            mm_block_space(l);     
            
            % d4. store landmark pointers
            lm_associate_pointer_to_lmk(l,i);    
            
            % d5. measurement Yi of landmark 'i'
            Yi = sim_get_lmk_measurement(i);
            
            % d6. Landmark initialization in the map. Update x and P:
            %   get x(l), landmark state
            %   get Jacobians L_r and L_y
            [x(l), L_r, L_y] = invObserve(x(r),Yi);
            P(l,rm)          = L_r*P(r,rm);
            P(rm,l)          = P(l,rm)';
            P(l,l)           = L_r*P(r,r)*L_r'+L_y*S*L_y';
            
        end % if numel(l) >= 2
    end % if ~isempty(i)
    
    % II.3 GRAPHICS -------------------------------------------------------
    
    draw_graphics(x,P,r,lm_all_lmk_pointers())
    
    % If needed, use next line to slow down the loop
    % pause(1)
end



