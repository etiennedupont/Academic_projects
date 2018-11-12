# Motion planning with a robotic arm
- We implemented a Rapidly exploring Random Tree (RRT) algorithm to plan motions on a simple case without constraints
- We implemented RRT on a more complex case with constraints: the robotic arm hold a ball and put it in a box. Constraints on the configuration when holding the ball compel us to evolve within a sub-manifold of the configuraiton space. We used a constraints graph to manage this case.
