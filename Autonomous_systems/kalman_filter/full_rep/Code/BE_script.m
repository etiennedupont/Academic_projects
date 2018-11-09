%==========================================================================
%==========================================================================
% BE Navigation 
%==========================================================================
%==========================================================================

clearvars
close all

%--------------------------------------------------------------------------
% Modèle de SIMULATION
%--------------------------------------------------------------------------

% Modèle du VEHICULE
[paramENG,initENG] = modele_VEHICULE('model_ENG_1');

% Trajectoire de l'ENGIN (séquence des consignes)
[IN_consVIT,IN_consPHI] = modele_TRAJECTOIRE('model_TRA_1');

% Modèle des ODOMETRES
[paramODO] = modele_ODOMETRE('model_ODO_1');

% Modèle de l'IMU
[paramIMU] = modele_IMU('model_IMU_1');

% Modèle de GPS
[paramGPS] = modele_GPS('model_GPS_1');


%--------------------------------------------------------------------------
% Estimateur
%--------------------------------------------------------------------------

[paramEST,initEST] = modele_ESTIMATEUR('model_EST_1',paramENG);


%--------------------------------------------------------------------------
% Simulation
%--------------------------------------------------------------------------

% Paramètres de simulation
paramSIM.T	= 180;       % Durée

% Simulation
sim('schemaSIM');


%--------------------------------------------------------------------------
% Tracés
%--------------------------------------------------------------------------

% Consignes et réponses des actionneurs
plot_COMMANDE(OUT_consVIT,OUT_VIT,OUT_consPHI,OUT_PHI);

% Trajectoire du VEHICULE
plot_VEHICULE(OUT_posENG,OUT_attENG);

% Les vitesses
plot_VITESSE(OUT_consVIT,OUT_VIT,OUT_vitENG,OUT_vitROUE);

% Les mesures
plot_ODOMETRE(OUT_vitROUE,OUT_vitODO);
plot_IMU(OUT_omeENG,OUT_omeIMU);
plot_GPS(OUT_posENG,OUT_posGPS);

% Les estimations
% plot_ESTIMATEUR(OUT_posENG,OUT_posEST,OUT_attENG,OUT_attEST);
