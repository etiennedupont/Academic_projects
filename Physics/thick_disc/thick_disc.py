# -*- coding: utf-8 -*-
"""
Created on Sun Mar 18 17:55:21 2018

@author: Baptiste
"""

#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Wed Jan 31 17:33:42 2018

@author: etiennedupont
"""
import numpy as np
import math
from pylab import *

#Constantes
G = 6.67e-11
c = 3.00e8
Ka = 1.2e10
Ye = 0.5
K = Ye**(4/3)*Ka
#Données
Ms = 2e30
alpha = 0.2
M = 2.44 * Ms
Rs = 2*G*M/c**2

#
Rl_min = Rs*(1 + 1/(2 - 2*alpha))
Rl_max = Rs*(1 + 1/(1/2 - alpha))



def Phitilde(Rl,Rin,w):
    lin = ((Rin/Rl)**alpha)*((Rl*G*M)**(0.5))/(1-Rs/Rl)
    return -G*M/(w-Rs) - (lin/Rin)**2 * (1/(2-2*alpha))*(1 - (Rin/w)**(2-2*alpha))

def SurfEquipot(R0, Rin, Rl, pas, precision):
    lin = ((Rin/Rl)**alpha)*((Rl*G*M)**(0.5))/(1-Rs/Rl)
    phitilde = Phitilde(Rl,Rin,R0)
    w = R0
    listew = []
    listez = []
    listew2 = []
    listez2 = []
    radicande = -(w)**2+(Rs-((G*M)/(phitilde+(lin/Rin)**2*(1/(2-2*alpha))*(1-(Rin/w)**(2-2*alpha)))))**2   
    while(radicande >= 0):
        listew.append(w/Rs)
        listew2.append(w/Rs)
        listez.append(-radicande**(1/2)/Rs)
        listez2.append(radicande**(1/2)/Rs)
        w = w + pas
        radicande = -(w)**2+(Rs-((G*M)/(phitilde+(lin/Rin)**2*(1/(2-2*alpha))*(1-(Rin/w)**(2-2*alpha)))))**2
    while abs(radicande) < precision:
        pas /= 2
        if radicande<0:
            w -= pas
        else:
            w += pas
        radicande = -(w)**2+(Rs-((G*M)/(phitilde+(lin/Rin)**2*(1/(2-2*alpha))*(1-(Rin/w)**(2-2*alpha)))))**2
    listew.append(w/Rs)
    listez.append(0) 
    listew2.append(w/Rs)
    listez2.append(0)
    plot(listew2,listez2)
    plot(listew,listez)
    return listew, listez

            
def fonctionF(x, M, alpha):
    Rs = 2*G*M/c**2
    return (G*M)**(0.5)*x**(0.5-alpha)/(1-Rs/x)

def Dichotomie_Rc(M, Rl, alpha, nb):
    Rs = 2*G*M/c**2
    Rmin = Rs*(1+(1/(0.5-alpha)))
    csteTest = fonctionF(Rl, M, alpha)
    pas = Rmin - Rl
    if pas <0:
        print("erreur; Rmin < Rl")
        return
    else:
        while fonctionF(Rmin, M, alpha)<=csteTest:
            Rmin=Rmin+pas
        R = Rmin
        for i in range(0,nb):
            if fonctionF(R, M, alpha)<=csteTest:
                R = R + pas
                pas = pas/2.
            else:
                R = R - pas
                pas = pas/2.
    return R


#Q3-Q4-Q5 calculs de la masse / du rayon
    
def Coord_z(Rl,Rin,w):
    lin = ((Rin/Rl)**alpha)*((Rl*G*M)**(0.5))/(1-Rs/Rl)
    phitilde = Phitilde(Rl,Rin,Rin)
    radicande = -(w)**2+(Rs-((G*M)/(phitilde+(lin/Rin)**2*(1/(2-2*alpha))*(1-(Rin/w)**(2-2*alpha)))))**2
    if radicande >= 0:
        return radicande**(0.5)
    else:
        return - math.inf
    
def Dichotomie_wout(Rl,Rin,prec):
    Rc = Dichotomie_Rc(M,Rl,alpha,100)
    dR = Rc - Rin
    wout = Rc
    z = Coord_z(Rl,Rin,wout)
    while z > 0:
        wout += dR
        z = Coord_z(Rl,Rin,wout)
    while abs(z) > prec:
        dR = dR / 2
        if z < 0:
            wout -= dR
        else:
            wout += dR
        z = Coord_z(Rl,Rin,wout)
    return wout

def Phitilde_complet(Rl,Rin,w,z):
    lin = ((Rin/Rl)**alpha)*((Rl*G*M)**(0.5))/(1-Rs/Rl)
    return -G*M/(math.sqrt(w**2+z**2)-Rs) - (lin/Rin)**2 * (1/(2-2*alpha))*(1 - (Rin/w)**(2-2*alpha))

def Rho(Rl,Rin,w,z):
    phi_in = Phitilde_complet(Rl,Rin,Rin,0)
    phi = Phitilde_complet(Rl,Rin,w,z)
    return ((phi_in - phi)/(4*K))**3

def Masse(Rl,Rin,nw,nz):
    wout = Dichotomie_wout(Rl,Rin,10)
    M0 = 0
    dw = (wout - Rin) / nw
    for i in range(1, nw + 1):
        w = Rin + i * dw
        zout = Coord_z(Rl,Rin,w)
        dz = zout / nz
        for j in range(nz + 1):
            z = j * dz
            rho = Rho(Rl,Rin,w,z) 
            dM = 4 * math.pi * w * dw * dz * rho
            M0 += dM
    return M0

def Rayon_int_rempli(M,erreur,n): #erreur en %
    dR = (Rl_max-Rl_min)/2
    Rl = Rl_min + dR
    M0 = Masse(Rl,Rl,n,n/10)
    while abs(M0-M)/M * 100 > erreur:
        dR = dR / 2
        if M0 < M:
            Rl -= dR
        else:
            Rl += dR
        M0 = Masse(Rl,Rl,n,n/10)
    return Rl/Rs,M0/Ms


def Rayon_int(Rl,M0,erreur,n):
    Rc = Dichotomie_Rc(M,Rl,alpha,100)
    dR = (Rc-Rl)/2
    Rin = Rl + dR
    M1 = Masse(Rl,Rin,n,n/10)
    k = 0
    while abs(M1-M0)/M0 * 100 > erreur:
        if k>20:
            break
        k+=1
        dR = dR / 2
        if M1 < M0:
            Rin -= dR
        else:
            Rin += dR
        M1 = Masse(Rl,Rin,n,n/10)
    return Rin/Rs,M1/Ms


 ####### Développement numéro 1 ########
 
 #calcul de la masse contenue dans le cylindre de rayon w
 
def Masse_cyl(Rl,Rin,wout,nw,nz):
    M0 = 0
    dw = (wout - Rin) / nw
    for i in range(1, nw + 1):
        w = Rin + i * dw
        zout = Coord_z(Rl,Rin,w)
        dz = zout / nz
        for j in range(nz + 1):
            z = j * dz
            rho = Rho(Rl,Rin,w,z) 
            dM = 4 * math.pi * w * dw * dz * rho
            M0 += dM
    return M0

#calcul de w tel que Masse_cyl(w) = M

def w_deltaM(Rl,p,erreur,n): #erreur en %
    dM = p * Masse(Rl,Rl,n,n/10)
    Rc = Dichotomie_Rc(M,Rl,alpha,100)
    dw = (Rc-Rl)/2
    w = Rl + dw
    dM0 = Masse_cyl(Rl,Rl,w,n,n/10)
    while abs(dM0-dM)/dM * 100 > erreur:
        dw = dw / 2
        if dM0 < dM:
            w += dw
        else:
            w -= dw
        dM0 = Masse_cyl(Rl,Rl,w,n,n/10)
    return w/Rs,dM0/Ms
 
#calcul du moment cinétique perdu par le disque

def Moment(Rl,Rin,wout,nw,nz):
    lin = ((Rin/Rl)**alpha)*((Rl*G*M)**(0.5))/(1-Rs/Rl)
    J0 = 0
    dw = (wout - Rin) / nw
    for i in range(1, nw + 1):
        w = Rin + i * dw
        zout = Coord_z(Rl,Rin,w)
        dz = zout / nz
        for j in range(nz + 1):
            z = j * dz
            rho = Rho(Rl,Rin,w,z) 
            dM = 4 * math.pi * w * dw * dz * rho * lin * (w/Rin)**alpha
            J0 += dM
    return J0




def boucleint(win, wout, nw, zmax, nz, liste_m,j, Md, dMd, prec):
    ### initialisation du calcul
    liste_w = np.linspace(win, wout, nw)
    liste_z = np.linspace(0, zmax, nz)
    H = np.zeros(nw,nz)
    rho = np.zeros(nw,nz)
    phi0 = potentiel(win, 0)
    j0 = 0
    jprime = []
    for i in range(len(liste_m)):
        if dMd/Md < liste_m[i]:
            j0 = (j[liste_m[i]]+j[liste_m[i-1]])/2
            break
    I = 0
    for i in range(len(liste_w)):
        jprime.append = j0*(liste_w[i]/win)**0.2
        I+= jprime[i]**2/w**3*(wout-win)/nw    
        for j in range(len(liste_z)):
            if phi0-potentiel(liste_w[i],liste_z[j])+I >=0:
                H[liste_w[i],liste_z[j]]=phi0-potentiel(liste_w[i],liste_z[j])+I
                rho[liste_w[i],liste_z[j]]=(H/4*K)**3
                    
    ### boucle pour affiner rho
    liste_test = []
    for i in range(len(rho)):
        for r in rho[i]:
            liste_test.append(r)
    testcarre = 0
    test = testcarre**0.5
    for r in liste_test:
        if r != 0:
            testcarre += ((r-0)/r)**2
    test = len(liste_test)**(-0.5)*testcarre**0.5
    while(test > prec):
        mprime = 0
        for i in range(len(liste_w)):
            for j in range(len(liste_z)):
                mprime += (Md-dMd)**(-1)*(rho[liste_w[i],liste_z[j]]*zmax/nz*(wout-win)/nw)
            mseconde = (1-dMd/Md)*mprime+dMd/Md
            J=0
            for k in range(len(liste_m)):
                if mseconde< liste_m[i]:
                    J = (j[liste_m[i]]+j[liste_m[i-1]])/2
                    break
            Jprime = (1-dMd/Md)/(1-dJd/Jd)*J
            lprime = (Jd-dJd)/(Md-dMd)*Jprime
            I += lprime**2/w**3*(wout-win)/nw    
            for j in range(len(liste_z)):
                if phi0-potentiel(liste_w[i],liste_z[j])+I >=0:
                    H[liste_w[i],liste_z[j]]=phi0-potentiel(liste_w[i],liste_z[j])+I
                    rho[liste_w[i],liste_z[j]]=(H/4*K)**3
                else:
                    H[liste_w[i],liste_z[j]]=0
                    rho[liste_w[i],liste_z[j]]=0
        liste_test2 = []
        for i in range(len(rho)):
            for r in rho[i]:
                liste_test2.append(r)
        testcarre = 0
        test = testcarre**0.5
        for i in range(len(liste_test2)):
            if liste_test[i]!=0:
                testcarre += ((liste_test2[i]-liste_test[i])/liste_test[i])**2
            else:
                if liste_test2[i]!=0:
                    testcarre += 1
        test = len(liste_test2)**(-0.5)*testcarre**0.5
        liste_test = liste_test2
    return rho

def potentiel(w,z):
    return -G*M/((w^2+z^2)^(0.5)-Rg)

def creation_disque(Rl, Md, prec, alpha, nw, nz):
    win = Rl
    nb =1000
    wc = Dichotomie_Rc(M, Rl, alpha, nb)
    wout = Dichotomie_wout(Rl,Rl,prec)
    lin = ((Rl*G*M)**(0.5))/(1-Rs/Rl)
    liste_w = np.linspace(win, wout, 10000)
    liste_m = []
    for w in liste_w:
        liste_m.append(Masse_cyl(Rl,Rl,w,nw,nz))
    Jd = Moment(Rl, Rl, wout, nw, nz)
    j = []
    for w in liste_w:
        j.append(lin*(w/win)**0.2)
    liste_z = []
    for w in liste_w:
        liste_z.append(Coord_z(Rl,Rl,w))
    zmax = max(liste_z)
    return win, wc, wout, zmax, Jd, liste_m, j


 ####### Développement numéro 1 ########


def main(Rl, M, alpha, Md, p, erreur, nw, nz, prec, nombre_iterations):
    ### cree le disque initial, de masse Md, correspondant au
    ### trou noir initial
    disque_initial = creation_disque(Rl, Md, prec, alpha, nw, nz)
    win_i = disque_initial[0]
    wc = disque_initial[1]
    wout = disque_initial[2]
    zmax = disque_initial[3]
    Jd = disque_initial[4]
    liste_m = disque_initial[5]
    j = disque_initial[6]
    
    ### calcul du moment extrait du disque
    wout = Rs*w_deltaM(Rl,p,erreur,n)[0]
    dJd = Moment(Rl, Rl, wout, nw, nz)
    
    ### premier test du disque
    rho = boucleint(win_i, wout, nw, zmax, nz, liste_m, j, Jd, dJd, prec)
    w = win_i
    Mdprime = 0
    for i in range(len(rho)):
        for j in range(len(rho[i])):
            Mdprime += rho[i][j]*(wout-win_i)/nw*zmax/nz*4*np.pi*w
        w+=(wout-win_i)/nw
        
    if Mdprime < Md-dMd:
        print "le disque est instable"
        return
        
    else:
        ### dichotomie sur win entre win et wc initiaux
        cmpt = 1
        win = (win_i+wc)/2
        while (cmpt<nombre_iterations):
            rho = boucleint(win, wout, nw, zmax, nz, liste_m, j, Jd, dJd, prec)
            w = win
            Mdprime = 0
            for i in range(len(rho)):
                for j in range(len(rho[i])):
                    Mdprime += rho[i][j]*(wout-win)/nw*zmax/nz*4*np.pi*w
                w+=(wout-win)/nw
            if Mdprime >= Md-dMd:
                win_i = win
                win = (wc + win_i)/2
            else:
                wc = win
                win = (wc + win_i)/2
            cmpt+=1
        print "le disque est stable"