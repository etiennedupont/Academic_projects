
(define (domain ewr1)
  (:requirements :typing :negative-preconditions :equality :universal-preconditions :durative-actions :fluents)

  (:types 
   location	   ; either a zone or the "base" location
   zone	- location ; several connected zones
   robot	   ; carries at most 1 instrument
   instrument	   ; used by a robot to achieve tasks
   task		   ; activity to be achieved in various zones
   )


  (:constants base - location)

  (:predicates
   (adjacent ?z1  ?z2 - location)    ; location ?z1 is adjacent to ?z2
   (at ?x - robot ?z - location)     ; robot ?x is at location ?z
   (carry ?r - robot ?i - instrument) ; robot ?r carries an instrument ?i
   (bare ?r - robot)		      ; robot ?r has no instrument
   (achieved ?t - task ?z - zone) ; task ?t in zone ?z has been achieved
   (adapted ?i - instrument ?t - task) ; instrument ?i can be used for task ?t
   (available ?i - instrument) ; instrument ?i is available at the base
   )

  ;; there are 4 operators in this domain:

  (:durative-action Move                                
		    :parameters (?r - robot ?from ?to - location)
		    :duration  (= ?duration 5)
		    :condition (and 

				)
		    :effect (and 
			
			     ))

  ;; mount instrument?i on robot at base
  (:durative-action Mount
		    :parameters (?r - robot ?i - instrument)
		    :duration  (= ?duration 2)
		    :condition (and 
			   
				)
		    :effect (and 
			     ))


  ;; unmount instrument ?i from robot at base
  (:durative-action Unmount
		    :parameters (?r - robot ?i - instrument)
		    :duration  (= ?duration 2)
		    :condition (and

				)
		    :effect (and 
	   	   	
			     ))

  (:durative-action Perform                               
		    :parameters (   )
		    :duration  (= ?duration 10)
		    :condition (and 
			   
			   
				)
		    :effect 
		    )
  )


