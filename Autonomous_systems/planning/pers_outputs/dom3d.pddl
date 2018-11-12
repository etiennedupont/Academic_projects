
(define (domain ewr3)
  (:requirements :typing :negative-preconditions :equality :universal-preconditions :durative-actions :fluents)

  (:types 
   location		   ; either a zone or the "base" location
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
   (independent ?t -task)
   (require ?t1 ?t2 - task)
   )

  ....

  )


