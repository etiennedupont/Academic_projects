function [posEST,attEST,Xnp1,Pnp1]  = FILTRE(consVIT,consPHI,vitODO,omeIMU,posGPS,t,Xn,Pn,paramEST)

% [posEST,attEST,Xnp1,Pnp1]  = FILTRE(vitODO,omeIMU,posGPS,t,Xn,Pn,paramEST);
%--------------------------------------------------------------------------
%   consVIT :   consigne de vitesse
%   consPHI :   consigne de cap
%   vitODO :	mesure des vitesses des roues par ODOMETRE [100 Hz]
%   omeIMU :	mesure de la vitesse de rotation par IMU [100 Hz]
%   posGPS :	mesure de la position par GPS [1 Hz]
%   t :         date courante
%   Xn :        ?tat estim?
%   Pn :        covariance de l'erreur d'estimation d'?tat
% 
%   posEST :    position estim?e 
%   attEST :	attitude estim?e 
%   Xnp1 :  	?tat estim?
%   Pnp1 :  	covariance de l'erreur d'estimation d'?tat
%--------------------------------------------------------------------------

% Param?tres
dt  = paramEST.dt;
Q   = paramEST.Q;
R   = paramEST.R;

% D?codage des entr?es
x   = Xn(1,1);
y	= Xn(2,1);
the = Xn(3,1);
v   = Xn(4,1);
phi = Xn(5,1);

% Initialisation
Xnp1   = Xn;
Pnp1   = Pn;

L = 2;      % Distance inter-essieux

% Param?tres du contr?le du v?hicule
tauVIT = 3;   % Constante de temps sur la vitesse
tauPHI = 1;	% Constante de temps sur la braquage


%--------------------------------------------------------------------------
% Pr?diction
%--------------------------------------------------------------------------
x_pred = x + dt*v*cos(the);
y_pred = y + dt*v*sin(the);
the_pred = the + dt*v*tan(phi)/L;
v_pred = v + dt*(consVIT - v)/tauVIT;
phi_pred = phi + dt*(consPHI-phi)/tauPHI;

Xn_pred = [x_pred;y_pred;the_pred;v_pred;phi_pred]; %Position pr?dite
F = [1 0 -dt*v*sin(the) dt*cos(the) 0 ;...
     0 1 dt*v*cos(the) dt*sin(the) 0 ;...
     0 0 1 dt*tan(phi)/L dt*(1+tan(phi)^2)/L ;...
     0 0 0 1-dt/tauVIT 0 ;...
     0 0 0 0 1-dt/tauPHI ];

Pn_pred = F*Pn*F' + Q; %Covariance pr?dite

%--------------------------------------------------------------------------
% Correction
%--------------------------------------------------------------------------
if((rem(t,1))==0 &&(t>0.2))
    H = [1 0 0 0 0 ; 0 1 0 0 0 ; 0 0 0 tan(phi_pred)/L v_pred*(1+tan(phi_pred))^2/L];
    Z = [posGPS ; omeIMU] - [x_pred ; y_pred ; v_pred*tan(phi_pred)/L]; %Innovation
    S = H*Pn_pred*H' + R; %Covariance innovation
    K = Pn_pred*H'/S; %Gain de Kalman optimal
    Xnp1 = Xn_pred + K*Z;
    Pnp1 = (eye(5,5)-K*H)*Pn_pred;
else
    Xnp1 = Xn_pred;
    Pnp1 = Pn_pred;
end

%--------------------------------------------------------------------------
% Codage des sorties
%--------------------------------------------------------------------------
posEST = [Xnp1(1,1);Xnp1(2,1)];
attEST = Xnp1(3,1);

