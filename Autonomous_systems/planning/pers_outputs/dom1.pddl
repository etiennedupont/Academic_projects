
(define (domain ewr1)
  
  (:types 
   location		    ; either a zone or the "base" location
   zone	- location	    ; several connected zones
   robot		    ; carries at most 1 instrument
   instrument		    ; used by a robot to achieve tasks
   task			    ; activity to be achieved in various zones
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

  ;; move a robot between two adjacent zones
  (:action move                                
	   :parameters (?r - robot ?from ?to - location) 
	   :precondition (and ... 
			      )
	   :effect (and  ...
			 )	   
	   )


  ;; mount instrument ?i on robot ?r at while at base 
  (:action mount
	   ....
	   )


  ;; unmount instrument ?i from robot while at base
  (:action unmount
	   ....
	   )


  ;; perform task ?t at zone ?z by robot ?r with instrument ?i
  (:action perform                                
	   ....	     	   

	   )
  )



