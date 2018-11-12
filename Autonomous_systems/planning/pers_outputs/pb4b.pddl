
(define (problem ewr4b)
    (:domain ewr4)

  (:objects ra rb rc rd - robot
    	    z1 z2 z3 z4 z5 z6 z7 - zone
	    socle1 socle2 socle3 brosses1 brosses2 - instrument
	    buttage binage - task)

  (:init (adjacent z1 z2) (adjacent z2 z1)
	 (adjacent z2 z3) (adjacent z3 z2)
	 (adjacent z3 z4) (adjacent z4 z3)
	 (adjacent z1 base) (adjacent base z1)
	 (adjacent z3 base) (adjacent base z3)
	 (adjacent z4 base) (adjacent base z4)
	 (adjacent z5 base) (adjacent base z5)
	 (adjacent z6 base) (adjacent base z6)
	 (adjacent z7 base) (adjacent base z7)
	 
	 (freezone z1)
	 (freezone z2)
	 (freezone z3)
	 (freezone z4)
	 (freezone z5)
	 (freezone z6)
	 (freezone z7)

	 (at ra base) (bare ra)
	 (at rb base) (bare rb)
	 (at rc base) (bare rc)
	 (at rd base) (bare rd)
	 
	 (available socle1) (available socle2) (available socle3)
	 (available brosses1) (available brosses2)

	 
	 (adapted socle1 binage)
	 (adapted socle2 binage)
	 (adapted socle3 binage)
	 
	 (adapted brosses1 buttage)
	 (adapted brosses2 buttage)

	 (= (taskduration binage) 30)
	 (= (taskduration buttage) 10)
	 
	 (independent binage)
         (require buttage binage)

	 )

  (:goal (and (forall (?z - zone)
		      (achieved buttage ?z)
		      )
	      (at ra base)
	      (at rb base)
	      (at rc base)
	      (at rd base)
	      )
	 )
 
  )
