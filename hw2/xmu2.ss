(define fib (lambda (n)
	(cond
    ((not (number? n)) "Input must be a number")
	((<= n 2) 1)
	(else  (+ (fib (- n 1)) (fib (- n 2))))
	)))

; (display (fib 5)) ; output 5


(define rac (lambda (arr)
(
	cond
		((null? arr) arr)
		; ((number? arr) "Input must be a list")
		((null? (cdr arr)) (car arr))
		(else (rac (cdr arr)))
)
)
)

; (display (rac (list 'A 'B 'C))) ; output C


(define snoc (lambda (elem arr) (
		cond
            ; ((number? arr) "Input must be a list")
			((null? arr) (list elem))
			(else (cons (car arr) (snoc elem (cdr arr))))
		)
	)
)

; (display (snoc '4 (list ))) ; output (4)
; (display (snoc '4 (list '1 '2 '3))) ; output (1 2 3 4)


(define rdc (lambda (arr)
	(
		cond
		((null? arr) arr)
        ; ((number? arr) "Input must be a list")
		((null? (cdr arr)) (list))
		(else (cons (car arr) (rdc (cdr arr))))
	)
))

; (display (rdc (list 'A 'B 'C))) ; output (A B)
; (display (rdc (list 'A))) ; output ()


(define pr (lambda (arr)(
	cond
	((null? arr) arr)
    ; ((number? arr) "Input must be a list")
	(else (cons (rac arr) (pr (rdc arr))))
    )
  )
)

; (display (pr (list 'A 'B 'C))) ; output C B A
; (display (pr (list 'A))) ; output A
; (display (pr (list ))) ; output ()