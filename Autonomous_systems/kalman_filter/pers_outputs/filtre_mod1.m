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

% Initialisation
Xnp1   = Xn;
Pnp1   = Pn;

%--------------------------------------------------------------------------
% Pr?diction
%--------------------------------------------------------------------------
B = [cos(the) 0 ; sin(the) 0 ; 0 1].*dt;
F = eye(3,3);
U = [consVIT ; omeIMU];
Xn_pred = F*Xn + B*U; %Position pr?dite
Pn_pred = F*Pn*F' + Q; %Covariance pr?dite

%--------------------------------------------------------------------------
% Correction
%--------------------------------------------------------------------------
if((rem(t,1))==0 &&(t>0.2))
    H = [1 0 0 ; 0 1 0];
    Z = posGPS - H*Xn_pred; %Innovation
    S = H*Pn_pred*H' + R; %Covariance innovation
    K = Pn_pred*H'/S; %Gain de Kalman optimal
    Xnp1 = Xn_pred + K*Z;
    Pnp1 = (eye(3,3)-K*H)*Pn_pred;
else
    Xnp1 = Xn_pred;
    Pnp1 = Pn_pred;
end

%--------------------------------------------------------------------------
% Codage des sorties
%--------------------------------------------------------------------------
posEST = [Xnp1(1,1);Xnp1(2,1)];
attEST = Xnp1(3,1);

