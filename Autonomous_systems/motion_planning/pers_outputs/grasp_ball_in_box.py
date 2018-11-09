from math import sqrt
from hpp import Transform
from hpp.corbaserver.manipulation import ConstraintGraph
from manipulation import robot, vf, ps, Ground, Box, Pokeball, PathPlayer, gripperName, ballName

import readline
import rlcompleter
readline.parse_and_bind ("tab: complete")

vf.loadEnvironmentModel (Ground, 'ground')
vf.loadEnvironmentModel (Box, 'box')
vf.moveObstacle ('box/base_link_0', [0.3+0.04, 0, 0.04, 0, 0, 0, 1])
vf.moveObstacle ('box/base_link_1', [0.3-0.04, 0, 0.04, 0, 0, 0, 1])
vf.moveObstacle ('box/base_link_2', [0.3, 0.04, 0.04, 0, 0, 0, 1])
vf.moveObstacle ('box/base_link_3', [0.3, -0.04, 0.04, 0, 0, 0, 1])

vf.loadObjectModel (Pokeball, 'pokeball')
robot.setJointBounds ('pokeball/root_joint', [-.4,.4,-.4,.4,-.1,1.,
                                              -1.0001, 1.0001,-1.0001, 1.0001,
                                              -1.0001, 1.0001,-1.0001, 1.0001,])

r = vf.createViewer ()

q1 = [0, -1.57, 1.57, 0, 0, 0, .3, 0, 0.025, 0, 0, 0, 1]
r (q1)

## Create graph
graph = ConstraintGraph (robot, 'graph')

#Create Nodes & Edges
graph.createNode(['grasp-placement','ball-above-ground','grasp','gripper-above-ball','placement'])
graph.createEdge ('placement', 'placement', 'transit', 1, 'placement')
graph.createEdge ('grasp', 'grasp', 'transfer', 1, 'grasp')

graph.createEdge('placement','gripper-above-ball','approach-ball',1,'placement')
graph.createEdge('gripper-above-ball','placement','move-gripper-away',1,'placement')
graph.createEdge('grasp','ball-above-ground','approach-ground',1,'grasp')
graph.createEdge('ball-above-ground','grasp','take-ball-away',1,'grasp')

graph.createEdge('gripper-above-ball','grasp-placement','grasp-ball',1,'placement')
graph.createEdge('grasp-placement','gripper-above-ball','move-gripper-up',1,'placement')
graph.createEdge('ball-above-ground','grasp-placement','put-ball-down',1,'grasp')
graph.createEdge('grasp-placement','ball-above-ground','take-ball-up',1,'grasp')



##Create transformation constraint: ball is in horizontal plane with free rotation around z
ps.createTransformationConstraint ('placement', '', ballName, [0,0,0.025,0, 0, 0, 1], [False, False, True, True, True, False,])
#  Create complement constraint
ps.createTransformationConstraint ('placement/complement', '', ballName, [0,0,0.025,0, 0, 0, 1], [True, True, False, False, False, True,])

## Create constraint of relative position of the ball in the gripper when ball is grasped
ballInGripper = [0, .137, 0, 0.5, 0.5, -0.5, 0.5]
ps.createTransformationConstraint ('grasp', gripperName, ballName, ballInGripper, 6*[True,])

ps.createTransformationConstraint ('gripper-above-ball',gripperName, ballName,[0, .3, 0, 0.5, 0.5, -0.5, 0.5],6*[True,])
ps.createTransformationConstraint('ball-above-ground','',ballName,[0,0,0.3,0,0,0,1],[False,False,True,True,True,False])
ps.createTransformationConstraint('change-in-altitude-only','',gripperName,[0,0,0.3,0,0,0,1],[True,True,False,True,True,True])

ps.setConstantRightHandSide ('placement', True)
ps.setConstantRightHandSide ('gripper-above-ball', True)
ps.setConstantRightHandSide ('ball-above-ground', True)
ps.setConstantRightHandSide ('placement/complement', False)
ps.setConstantRightHandSide ('change-in-altitude-only', False)


## Set constraints of nodes and edges
graph.setConstraints (node='placement', numConstraints = ['placement'])
graph.setConstraints (node='grasp', numConstraints = ['grasp'])
graph.setConstraints(node='ball-above-ground',numConstraints = ['grasp','ball-above-ground'])
graph.setConstraints(node='grasp-placement',numConstraints = ['grasp','placement'])
graph.setConstraints(node='gripper-above-ball',numConstraints = ['gripper-above-ball','placement'])

# These edges are in node 'placement'
graph.setConstraints (edge='transit',numConstraints = ['placement/complement'])
                                  
graph.setConstraints (edge='move-gripper-away',numConstraints = ['placement/complement'])
graph.setConstraints (edge='approach-ball',numConstraints = ['placement/complement'])

graph.setConstraints (edge='move-gripper-up',numConstraints = ['placement/complement','change-in-altitude-only'])
graph.setConstraints (edge='grasp-ball',numConstraints = ['placement/complement','change-in-altitude-only'])

# These edges are in node 'grasp'
graph.setConstraints (edge='take-ball-up', numConstraints = ['change-in-altitude-only'])
graph.setConstraints (edge='put-ball-down', numConstraints = ['change-in-altitude-only'])

graph.setConstraints (edge='take-ball-away', numConstraints = [])
graph.setConstraints (edge='approach-ground', numConstraints = [])

graph.setConstraints (edge='transfer',     numConstraints = [])



res, q_init, error = graph.applyNodeConstraints ('placement', q1)
q2 = q1 [::]
q2 [7] = .2

res, q_goal, error = graph.applyNodeConstraints ('placement', q2)

ps.setInitialConfig (q_init)
ps.addGoalConfig (q_goal)
ps.selectPathValidation ("Discretized", 0.01)
ps.selectPathProjector ("Progressive", 0.1)

pp = PathPlayer (ps.client.basic, r)

def test_node_constraints(node):
    for i in range(100):
        q=robot.shootRandomConfig()
        res,q,err=graph.applyNodeConstraints(node,q)
        if res : return(q)
    return

def test_transition_constraints(transition,qa):
    for i in range(1000):
        qrand = robot.shootRandomConfig()
        res, qb, err = graph.generateTargetConfig(transition,qa,qrand)
        if res:
            print(i)
            return qb
    return




