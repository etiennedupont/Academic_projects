function [paramGPS] = modele_GPS(nom)

% [paramGPS] = modele_GPS(nom);
%--------------------------------------------------------------------------
% Modèle GPS
%--------------------------------------------------------------------------
%   nom :   Nom du modèle à utiliser
%
%	paramGPS :	structure contenant les paramètres du modèle
%--------------------------------------------------------------------------

if nargin==0
    nom = 'model_GPS_1';
end;

switch nom
    
    case 'model_GPS_1'
        
        % Paramètres
        paramGPS.dt         = 1.0;	% Pas d'échantillonnage [s]
        paramGPS.sig_pos    = 2/3;	% Ecart-type du bruit [m]
        paramGPS.per_sau    = 30;	% Période moyenne entre sauts [s]
        paramGPS.amp_sau    = 10;	% Amplitude maximale du cumul des sauts [s]
        
    otherwise
        error('Modele GPS inconnu');
        
end;
