function [paramEST,initEST] = modele_ESTIMATEUR(nom,paramENG)

% [paramEST,initEST] = modele_ESTIMATEUR(nom,paramENG);
%--------------------------------------------------------------------------
% ESTIMATEUR
%--------------------------------------------------------------------------
%   nom :   Nom du mod�le � utiliser
%
%	paramEST :	structure contenant les param�tres
%	initEST :   structure contenant les initialisations
%--------------------------------------------------------------------------

if nargin==0
    nom = 'model_EST_1';
end;

% Param�tres g�om�triques du v�hicule
H = paramENG.H;      % Demi-longueur de l'essieu arri�re
L = paramENG.L;      % Distance inter-essieux

% Param�tres du contr�le du v�hicule
tauVIT = paramENG.tauVIT;   % Constante de temps sur la vitesse
tauPHI = paramENG.tauPHI;	% Constante de temps sur la braquage


switch nom
    
    case 'model_EST_1'
        %------------------------------------------------------------------
        % Etat = [pos;att]
        %------------------------------------------------------------------
                
        % Param�tres de l'ESTIMATEUR
        paramEST.dt	= 0.01;     % Pas d'�chantillonnage [s]
        paramEST.Q = 0;
        paramEST.R = 0;       
        
        % Etat initial
        initEST.POS	= [0 ; 0];	% Position du v�hicule
        initEST.ATT	= 0;        % Direction du v�hicule [�]

        % Enregistrement
        initEST.x	= [initEST.POS;initEST.ATT*pi/180];
        initEST.nx	= length(initEST.x);
                
        % Covariance initiale
        P = ones(initEST.nx,initEST.nx);
        
        % Enregistrement
        initEST.P = P;
        
        
    case 'model_EST_2'
        %------------------------------------------------------------------
        % Etat = [pos;att;VIT;PHI]
        %------------------------------------------------------------------
                
        % Param�tres de l'ESTIMATEUR
        paramEST.dt	= 0.01;     % Pas d'�chantillonnage [s]
        paramEST.Q = 0;
        paramEST.R = 0;       
        
        % Etat initial
        initEST.POS	= [0 ; 0];	% Position du v�hicule
        initEST.ATT	= 0;        % Direction du v�hicule [�]
        initEST.VIT	= 0;        % Vitesse du v�hicule
        initEST.PHI	= 0;        % Angle de braquage des roues [�]

        % Enregistrement
        initEST.x	= [initEST.POS;initEST.ATT*pi/180;initEST.VIT;initEST.PHI];
        initEST.nx	= length(initEST.x);
                
        % Covariance initiale
        P = ones(initEST.nx,initEST.nx);
        
        % Enregistrement
        initEST.P = P;
        
    otherwise
        
        error('Modele ESTIMATEUR inconnu');
        
end;

