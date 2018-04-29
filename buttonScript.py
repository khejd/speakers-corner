while True: #run forever 
	if GPIO.input(10) == GPIO.HIGH: 
		pyautogui.keyDown('ctrl')
	pyautogui.keyUp('ctrl') 
