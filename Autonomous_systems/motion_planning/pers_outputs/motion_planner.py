class MotionPlanner:
  def __init__ (self, robot, ps):
    self.robot = robot
    self.ps = ps

  def solveBiRRT (self, maxIter = float("inf")):
    self.ps.prepareSolveStepByStep ()
    finished = False
    robot = self.robot
    ps = self.ps

    # In the framework of the course, we restrict ourselves to 2 connected components.
    nbCC = self.ps.numberConnectedComponents ()
    if nbCC != 2:
      raise Exception ("There should be 2 connected components.")

    iter = 0
#   goal
    q2 = [1.57, -1.57, -1.8, 0, 0.8, 0] #=q3 de rrt.py
#    q2 = [0, -1.57, 1.57, 0, 0, 0] #=q1 de rrt.py
#   start
    q1 = [0.2, -1.57, -1.8, 0, 0.8, 0] #=q2 de rrt.py
    newConfigs = [[q1],[q2]]
    while True:
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
      #print("path id2 : "+str(id2))
      #print("numberpath : "+str(ps.numberPaths()))
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
      #print("Iter = "+str(iter))
      #print("nbCC = "+str(nbCC))
      if nbCC == 1:
        # Problem solved
        finished = True
        break
      iter = iter + 1
      if iter > maxIter:
        break
    if finished:
        self.ps.finishSolveStepByStep ()
        return self.ps.numberPaths () - 1

  def solvePRM (self):
    self.ps.prepareSolveStepByStep ()
    #### PRM begin
    #### PRM end
    self.ps.finishSolveStepByStep ()
