package edu.esprit.game.levels;

import edu.esprit.game.models.Employee;
import edu.esprit.game.utils.Data;

import java.util.List;
import java.util.stream.Collectors;

public class Level2 {
	public static void main(String[] args) {
	List<Employee> employees = Data.employees();

	/* TO DO 1: Retourner le nombre des employes dont le nom commence avec n */
	long nbr = employees.stream()
                .filter(t -> t.getName().startsWith("n"))
                .count();
       
				
	/* TO DO 2: Retourner la somme des salaires de tous les employes (hint: mapToInt) */	
	long sum = employees.stream()
                .mapToInt((t) -> t.getSalary())
                .sum();	
		
	/* TO DO 3: Retourner la moyenne des salaires des employ�s dont le nom commence avec s */	
	double average = employees.stream()
                .filter(t -> t.getName().startsWith("s"))
                .mapToDouble(t -> t.getSalary())
                .average()
                .getAsDouble();
		
	/* TO DO 4: Retourner la liste de tous les employ�s  */	
	List<Employee> emps = employees.stream()
                .collect(Collectors.toList());
                //.toSet() --retourner une SET
                //.toCollection(()->new TreeSet<>()) --retourner une LIST , SET ou MAP spécifique [ArrayList,TreeSet,HashSet,etc..]
		
	/* TO DO 5: Retourner la liste des employ�s dont le nom commence par s */	
	List<Employee> emps2 = employees.stream()
                .filter(t -> t.getName().startsWith("s"))
                .collect(Collectors.toList());		
		
	/* TO DO 6: Retourner true si il y a au min un employ�s dont le salaire > 1000, false si non
	*/
	boolean test = employees.stream()
                .anyMatch(t -> t.getSalary() > 1000);
				
	/* TO DO 7: Afficher le premier employ� dont le nom commence avec s avec deux mani�res diff�rentes */
	/*First way*/
	employees.stream()
                .filter(t -> t.getName().startsWith("s"))
                .findFirst()
                .ifPresent(t -> System.out.println(t));
	/*Second way*/
	employees.stream()
                .filter(t -> t.getName().startsWith("s"))
                .limit(1) //limit(x) retourne les x premiers elements
		.forEach(t -> System.out.println(t));
                
	/* TO DO 8: Afficher le second employ� dont le nom commence avec s */
	employees.stream()
                .filter(t -> t.getName().startsWith("s"))
                .skip(1)
                .limit(1)
                .forEach(t -> System.out.println(t));
	}
}
