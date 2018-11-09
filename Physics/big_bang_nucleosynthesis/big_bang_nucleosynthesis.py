import math
import numpy as npy
from scipy.optimize import fsolve
import matplotlib.pyplot as plt


#Evolution de T
T9 = 10**npy.arange(-1,0.3,0.05)

#ro la densité en Kg/cm**3
def ro(T9): return((1e-8)*T9**3)

#constantes
mu = 1.661e-27 #kg
Na = 6.022e23 #mol**-1

#Definitions avec T9 des taux de réaction de chaque réaction (Voir papier Smith, Kawano et Malaney)
def r1(T): return((ro(T)/(mu*Na))*4.742e4*(1-0.85*T**(1/2)+0.49*T-0.0962*T**(3/2)+8.47e-3*T**2-2.8e-4*T**(5/2)))

def r2(T): return((ro(T)/(mu*Na))*2.65e-3*T**(-2/3)*math.exp(-3.720/T**(1/3))*(1+0.112*T**(1/3)+1.99*T**(2/3)+1.56*T+0.162*T**(4/3)+0.324*T**(5/3)))

def r3(T): return((ro(T)/(mu*Na))*3.95e8*T**(-2/3)*math.exp(-4.259/T**(1/3))*(1+0.098*T**(1/3)+0.765*T**(2/3)+0.525*T+9.61e-3*T**(4/3)+0.0167*T**(5/3)))

def r4(T): return((ro(T)/(mu*Na))*4.17e8*T**(-2/3)*math.exp(-4.258/T**(1/3))*(1+0.098*T**(1/3)+0.518*T**(2/3)+0.355*T-0.010*T**(4/3)-0.018*T**(5/3)))

def r5(T): return((ro(T)/(mu*Na))*7.21e8*(1-0.508*T**(1/2)+0.228*T))

def r6(T): return((ro(T)/(mu*Na))*1.063e11*T**(-2/3)*math.exp(-4.559/T**(1/3)-(T/0.0754)**2)*(1+0.092*T**(1/3)-0.375*T**(2/3)-0.242*T+33.82*T**(4/3)+55.42*T**(5/3))+8.047e8*T**(-2/3)*math.exp(-0.4857/T))

def r7(T): return((ro(T)/(mu*Na))*5.021e10*T**(-2/3)*math.exp(-7.144/T**(1/3)-(T/0.270)**2)*(1+0.058*T**(1/3)+0.603*T**(2/3)+0.245*T+6.97*T**(4/3)+7.19*T**(5/3))+5.212e8/T**(1/2)*math.exp(-1.762/T))

def r8(T): return((ro(T)/(mu*Na))*4.817e6*T**(-2/3)*math.exp(-8.09/T**(1/3))*(1+0.0325*T**(1/3)-1.04e-3*T**(2/3)-2.37e-4*T-8.11e-5*T**(4/3)-4.69e-5*T**(5/3))+5.938e5*(T/(1+0.1071*T))**(5/6)*T**(-3/2)*math.exp(-12.859/(T/(1+0.1071*T))**(1/3)))

def r9(T): return((ro(T)/(mu*Na))*3.032e5*T**(-2/3)*math.exp(-8.09/T**(1/3))*(1+0.0516*T**(1/3)+0.0229*T**(2/3)+8.28e-3*T-3.28e-4*T**(4/3)-3.01e-4*T**(5/3))+5.109e5*(T/(1+0.1378*T))**(5/6)*T**(-3/2)*math.exp(-8.068/(T/(1+0.1378*T))**(1/3)))

def r10(T): return((ro(T)/(mu*Na))*2.675e9*(1-0.56*T**(1/2)+0.179*T-0.0283*T**(3/2)+2.21e-3*T**2-6.85e-5*T**(5/2))+9.391e8*((T/(1+13.076*T))/T)**(3/2)+4.467e7*T**(-3/2)*math.exp(-0.07486/T))

def r11(T): return((ro(T)/(mu*Na))*1.096e9*T**(-2/3)*math.exp(-8.472/T**(1/3))-4.830e8*(T/(1+0.759*T))**(5/6)*T**(-3/2)*math.exp(-8.472/(T/(1+0.759*T))**(1/3))+1.06e10*T**(-3/2)*math.exp(-30.442/T)+1.56e5*T**(-2/3)*math.exp(-8.472/T**(1/3)-(T/1.696)**2)*(1+0.049*T**(1/3)-2.498*T**(2/3)+0.86*T+3.518*T**(4/3)+3.08*T**(5/3))+1.55e6*T**(-3/2)*math.exp(-4.478/T))

def r12(T): return((ro(T)/(mu*Na))*888.54)
   

def equations(p):
    global T
    Yn,Yp,Y7Li,Y7Be,Yd,Y4He,Yt,Y3He, Y6Li = p
    e1 = 1/2*Yd**2*r3(T)+Yt*Yd*r6(T)-Yn*(Yp*r1(T)+Y3He*r5(T)+Y7Be*r10(T)+r12(T))
    e2 = 1/2*Yd**2+Y3He*Yn*r5(T)+r7(T)*Y3He*Yd+r10(T)*Y7Be*Yn+r12(T)*Yn-Yp*(r1(T)*Yn+r2(T)*Yd+r11(T)*Y7Li)
    e3 = r9(T)*Yt*Y4He+r10(T)*Y7Be*Yn-r11(T)*Y7Li*Yp
    e4 = r8(T)*Y3He*Yd-r10(T)*Y7Be*Yn
    e5 = r1(T)*Yp*Yn-Yd*(r2(T)*Yp+2*Yd*(r3(T)+r4(T))+r6(T)*Yt+r7(T)*Y3He)
    e6 = r6(T)*Yt*Yd+r7(T)*Y3He*Yd+2*r11(T)*Y7Li*Yp-Y4He*(r8(T)*Y3He+r9(T)*Yt)
    e7 = 1/2*Yd**2*r4(T)+Y3He*Yn*r5(T)-Yt*(Yd*r6(T)+Y4He*r9(T))
    e8 = Yd*Yp*r2(T)+1/2*Yd**2*r3(T)-Y3He*(Yn*r5(T)+Yd*r7(T)+Y4He*r8(T))
    e9 = 1 - (Yn+Yp+7*Y7Li+7*Y7Be+2*Yd+4*Y4He+3*Yt+3*Y3He+6*Y6Li)
    return(e1,e2,e3,e4,e5,e6,e7,e8,e9)

def res(T1,p):
    global T
    T=T1
    return fsolve(equations,p)
    
def operation():
    L = [[],[],[],[],[],[],[],[]]
    p = [1e-9,0.8,1e-9,1e-9,1e-4,0.19979,1e-6,1e-4,1e-13]
    for t in T9:
        r = res(t,p)
        L[0]+=[r[0]]
        L[1]+=[r[1]]
        L[2]+=[r[2]*7]
        L[3]+=[r[3]*7]
        L[4]+=[r[4]*2]
        L[5]+=[r[5]*4]
        L[6]+=[r[6]*3]
        L[7]+=[r[7]*3]
        p = r
    plt.plot(T9,L[0],L[1],L[2],L[3],L[4],L[5],L[6],L[7])
    plt.yscale('log')
    plt.xscale('log')
    plt.ylim(1e-24,1e1)
    plt.xlim(1e1,1e-1)
    plt.show()
    return()


