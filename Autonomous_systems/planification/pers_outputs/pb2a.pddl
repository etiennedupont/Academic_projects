
(define (problem ewr2a)
  (:domain ewr2)

  (:objects ra rb - robot
    	    z1 z2 z3 z4 - zone
	    socle brosses - instrument
	    buttage binage - task)

  (:init (adjacent z1 z2) (adjacent z2 z1)
	 (adjacent z2 z3) (adjacent z3 z2)
	 (adjacent z3 z4) (adjacent z4 z3)
	 (adjacent z1 base) (adjacent base z1)
	 (adjacent z4 base) (adjacent base z4)

	 (freezone z1)
	 (freezone z2)
	 (freezone z3)
	 (freezone z4)

	 (at ra base) (bare ra)
	 (at rb base) (bare rb)
	 
	 (available socle) (available brosses)
	 
	 (adapted socle binage)
	 (adapted brosses buttage)
	 )

  (:goal (and (forall (?z - zone)
		      (and (achieved binage ?z)
			   (achieved buttage ?z)))
	      (at ra base)
	      (at rb base))
	 )
 
  )
	 
	 
