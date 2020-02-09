#
# ===================================================================
# Purpose:           Averiguar si un numero es perfecto, abundante o defectivo
# Parameters:        uno
# Called From:       (script) any
# Author:            Fernando Santamaria
# Notes:             Additional information [long version]
# Revsion:           29/01/2020
# ===================================================================
#  
# ___________________________________________________________________
# 
# El metodo getDividers busca y acumula los valores de los numeros que son 
# divisores del valor que se pasa por parametro
# ___________________________________________________________________
#  

def getDividers(number):
	dividers = 0
	for i in range(1,int(round(float(number/2))) + 1):
		if number%i == 0:
			dividers = dividers + i

	return dividers

# ___________________________________________________________________
# 
# El metodo analyce evalua de que tipo de numero se trata comparando el valor
# del numero con sus factores ya sumados
# ___________________________________________________________________
#  

def analyze(number,tot):
	if number == tot:
		return "Perfecto"
	elif tot > number:
		return "Abundante"
	else:
		return "Defectivo"

# ___________________________________________________________________
# 
# Main de ejecución
# ___________________________________________________________________
#  

def main():
	inp = raw_input("Introduce un numero: ")
	try:
		num = int(inp)
		ret = getDividers(num)
		anl = analyze(num,ret)

		print(anl)

	except ValueError:
		print("El valor introducido no es un numero")

main()







	




