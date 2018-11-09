from grasp_ball_in_box import q_init, q_goal, robot, ps, graph, r, pp

## Strategy: 
## We build two paths :
# - the first one begins with the ball in the box (q_init in node placement) and ends in the node "grasp"
# - the second one begins in the node "grasp" and ends with the ball at the goal (q_goal in node placement)
## Then we just join both path in the node grasp

success = False
trial = 0
l_edges = ['approach-ball','grasp-ball','take-ball-up','take-ball-away']

#First step: building both paths
q_list = [q_init, q_goal]
paths_init = list ()
paths_goal = list ()
for i in range(2):
    qtemp_init = q_list[i]
    paths = list ()
    for edge in l_edges:
        success = False
        while not success:
       	# print ("trial {0}".format (trial)); trial += 1
            q = robot.shootRandomConfig ()
            res, q1, err = graph.generateTargetConfig (edge, qtemp_init, q)
            if not res: continue
            res, msg = robot.isConfigValid (q1)
            if not res: continue
            res, pid, msg = ps.directPath (qtemp_init, q1, True)
            if not res: continue
            if i==1: #second path: we need to go backward
                res, pid, msg = ps.directPath(q1, qtemp_init, True)
            if not res: continue
	    qtemp_init = q1
            paths.append (pid)
            success = True
    if i==0 :
        paths_init = paths
    else:
        paths.reverse()
        paths_goal = paths
    
#Second step: joining both paths in node grasp
q_init = ps.configAtParam(paths_init[len(paths_init)-1],ps.pathLength(paths_init[len(paths_init)-1]))
q_goal = ps.configAtParam(paths_goal[0],0)

res, pid, msg = ps.directPath (q_init, q_goal, True)
if not res: #then we need to perform rrt algorithm
   pid = rrt(q_init, q_goal) #classic rrt function below
paths = paths_init + [pid] + paths_goal
print(paths)


def rrt(q1, q2):
    ps.addConfigToRoadmap(q1,q2)
    newConfigs = [[q1],[q2]]
    #RRT Algo

    while True:
#      break
      #### RRT begin
      #TEST
      rq = robot.shootRandomConfig()
      q1=ps.getNearestConfig(rq,connectedComponentId=0)[0]
      q2=ps.getNearestConfig(rq,connectedComponentId=1)[0]
      id1=ps.directPath(q1,rq,True)[1]
      id2=ps.directPath(q2,rq,True)[1]
      q1_new=ps.configAtParam(id1,ps.pathLength(id1))
      q2_new=ps.configAtParam(id2,ps.pathLength(id2))
      id2=ps.directPath(q2_new,q2,True)[1]
      ps.addConfigToRoadmap(q1_new)
      ps.addConfigToRoadmap(q2_new)
      ps.addEdgeToRoadmap(q1,q1_new,id1,True)
      ps.addEdgeToRoadmap(q2_new,q2,id2,True)
      newConfigs[0].append(q1_new)
      newConfigs[1].append(q2_new)
      #TEST
      ## Try connecting the new nodes together
      for i in range (len(newConfigs[0])):
        res = ps.directPath(newConfigs[0][i],q2_new,True)
        if res[0]==True:
          ps.addEdgeToRoadmap(newConfigs[0][i],q2_new,res[1],False)
      for i in range (len(newConfigs[1])):
        res = ps.directPath(q1_new,newConfigs[1][i],True)
        if res[0]==True:
          ps.addEdgeToRoadmap(q1_new,newConfigs[1][i],res[1],False)
      #### RRT end
      ## Check if the problem is solved.
      nbCC = self.ps.numberConnectedComponents ()
      if nbCC == 1:
        # Problem solved
        finished = True
        break

    #End RRT Algo
    pid = ps.numberPaths () - 1
    return pid

