

(define (problem ewr1b)
  (:domain ewr1)

  (:objects rbt - robot
    	    z1 z2 z3 z4 z5 z6 z7 - zone
	    socle brosses - instrument
	    buttage binage - task)

  (:init (adjacent z1 z2) (adjacent z2 z1)
	 (adjacent z2 z3) (adjacent z3 z2)
	 (adjacent z3 z4) (adjacent z4 z3)
	 (adjacent z1 base) (adjacent base z1)
	 (adjacent z4 base) (adjacent base z4)
	 (adjacent z5 base) (adjacent base z5)
	 (adjacent z6 base) (adjacent base z6)
	 (adjacent z7 base) (adjacent base z7)
	 
	 (at rbt base) (bare rbt)

	 (available socle) (available brosses)

	 (adapted socle binage)
	 (adapted brosses buttage)
	 )

  (:goal (and (forall (?z - zone)
		      (achieved buttage ?z))
	      (at rbt base))
	 )
  )
	 
	 
