
(define (domain ewr2)
  (:requirements :typing :negative-preconditions :equality :universal-preconditions :durative-actions :fluents)

  (:types 
   location	   ; either a zone or the "base" location
   zone	- location ; several connected zones, at most 1 robot per zone
   robot	   ; carries at most 1 instrument
   instrument	   ; used by a robot to achieve tasks
   task		   ; activity to be achieved in various zones
   )


  (:constants base - location)

  (:predicates
   (adjacent ?z1  ?z2 - location)    ; location ?z1 is adjacent to ?z2
   (at ?x - robot ?z - location)     ; robot ?x is at location ?z
   (freezone ?z - zone)		     ; there is a robot at zone ?z
   (carry ?r - robot ?i - instrument) ; robot ?r carries an instrument ?i
   (bare ?r - robot)		      ; robot ?r has no instrument
   (achieved ?t - task ?z - zone) ; task ?t in zone ?z has been achieved
   (adapted ?i - instrument ?t - task) ; instrument ?i can be used for task ?t
   (available ?i - instrument) ; instrument ?i is available at the base
   )

  ;; there are 4 operators in this domain:

  ;; move a robot between two adjacent zones
  ;; no disjunction in optic conditions, hence the need for 3 actions for Move...
  (:durative-action Move                                
		    ) 

  (:durative-action Move-to-base                                

		    )

  (:durative-action Move-from-base
                                
		    )
  

  ;; mount instrument?i on robot at base 
  (:durative-action Mount
		    ....
		    )

  ;; unmount instrument ?i from robot at base
  (:durative-action Unmount
		    )

  ;; perform task ?t at zone ?z by robot ?r with instrument ?i
  (:durative-action Perform
		    )
  )


