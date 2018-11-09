function [e , E_r, E_p] = observe(r, p)

%   In:
%       r :     robot frame     r = [r_x ; r_y ; r_alpha]
%       p :     point in global frame
%   Out :
%       e :     measurement     y = [range ; bearing]
%       E_r :   Jacobian wrt r
%       E_p :   Jacobian wrt p

if nargout == 1 % No Jacobian requested
    e = scan(toFrame(r,p));

else %  Jacobians requested
    [pr,PR_r,PR_p] = toFrame(r,p);
    [e,E_pr] = scan(pr);
    
    E_r = E_pr*PR_r;
    E_p = E_pr*PR_p;
end

end