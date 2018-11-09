
(define (problem ewr1a)
  (:domain ewr1)

  (:objects rbt - robot
    	    z1 z2 z3 z4 - zone
	    socle brosses - instrument
	    buttage binage - task)

  (:init (adjacent z1 z2) (adjacent z2 z1)
	 (adjacent z2 z3) (adjacent z3 z2)
	 (adjacent z3 z4) (adjacent z4 z3)
	 (adjacent z1 base) (adjacent base z1)
	 (adjacent z4 base) (adjacent base z4)
	 
	 (at rbt base)
	 (bare rbt)

	 (available socle) (available brosses)

	 (adapted socle binage)
	 (adapted brosses buttage)

	 )

  (:goal (and (forall (?z - zone)
		      (achieved binage ?z))
	      (at rbt base))
	 )
  )
	 
	 
