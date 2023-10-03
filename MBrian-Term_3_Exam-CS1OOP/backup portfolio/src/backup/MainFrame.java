package backup;
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.Arrays;
import java.util.HashMap;
import java.util.Map;

public class MainFrame implements ActionListener {
	// Define variables for the main window and its elements at the class level
    private JFrame frame;
    private JMenuBar menuBar;
    private JMenu shapeMenu, equationMenu, statMenu;
    JMenuItem areaRectangleItem;
	private JMenuItem areaCircleItem;
	private JMenuItem areaTriangleItem;
	private JMenuItem areaCylinderItem;
	JMenuItem areaConeItem;
	private JMenuItem areaParallelogramItem;
	private JMenuItem areaTrapeziumItem;
	JMenuItem quadraticEquationItem;
	private JMenuItem basicStatsItem;
    private String rootsText; // Variable to store the roots text


    public MainFrame() {
        // Create the main frame and set its layout
        frame = new JFrame("Specialised Calculator");
        frame.setLayout(new BorderLayout());
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        // Create the menu bar and add menus to it
        menuBar = new JMenuBar();
        menuBar.setLayout(new BoxLayout(menuBar, BoxLayout.PAGE_AXIS)); // set layout manager to BoxLayout

        shapeMenu = new JMenu("Areas of selected shapes");
        equationMenu = new JMenu("Solve quadratic equations");
        statMenu = new JMenu("Basic Statistics");

        // Add menu items to the shape menu
        areaRectangleItem = new JMenuItem("Area of Rectangle");
        areaRectangleItem.addActionListener(this);
        shapeMenu.add(areaRectangleItem);

        areaCircleItem = new JMenuItem("Area of Circle");
        areaCircleItem.addActionListener(this);
        shapeMenu.add(areaCircleItem);

        areaTriangleItem = new JMenuItem("Area of Triangle");
        areaTriangleItem.addActionListener(this);
        shapeMenu.add(areaTriangleItem);

        areaCylinderItem = new JMenuItem("Surface Area of Cylinder");
        areaCylinderItem.addActionListener(this);
        shapeMenu.add(areaCylinderItem);

        areaConeItem = new JMenuItem("Surface Area of Cone");
        areaConeItem.addActionListener(this);
        shapeMenu.add(areaConeItem);

        areaParallelogramItem = new JMenuItem("Area of Parallelogram");
        areaParallelogramItem.addActionListener(this);
        shapeMenu.add(areaParallelogramItem);

        areaTrapeziumItem = new JMenuItem("Area of Trapezium");
        areaTrapeziumItem.addActionListener(this);
        shapeMenu.add(areaTrapeziumItem);

        // Add a menu item to the equation menu
        quadraticEquationItem = new JMenuItem("Solve Quadratic Equation");
        quadraticEquationItem.addActionListener(this);
        equationMenu.add(quadraticEquationItem);

        // Add a menu item to the statistics menu
        basicStatsItem = new JMenuItem("Calculate Basic Statistics");
        basicStatsItem.addActionListener(this);
        statMenu.add(basicStatsItem);

        // Add menus to the menu bar
        menuBar.add(shapeMenu);
        menuBar.add(equationMenu);
        menuBar.add(statMenu);

        // Add the menu bar to the frame
        frame.setJMenuBar(menuBar);

        // Set the frame size and make it visible
        frame.setSize(300, 300);
        frame.setLocationRelativeTo(null);
        frame.setVisible(true);
    }
    
    
    // Method to get the roots text
    public String getRootsText() {
        return rootsText;
    }
    
    // Inner class to represent a cone
    public class Cone {
        private double radius;
        private double height;

        // Constructor to initialize the radius and height of the cone
        public Cone(double radius, double height) {
            this.radius = radius;
            this.height = height;
        }

        // Method to calculate the surface area of the cone
        public double calculateSurfaceArea() {
            double slantHeight = Math.sqrt(height * height + radius * radius);
            double surfaceArea = Math.PI * radius * (radius + slantHeight);
            return surfaceArea;
        }
    }
    
    // Inner class to represent a cylinder
    public class Cylinder {
        private double radius;
        private double height;

        // Constructor to initialize the radius and height of the cylinder
        public Cylinder(double radius, double height) {
            this.radius = radius;
            this.height = height;
        }

        // Method to calculate the surface area of the cylinder
        public double calculateSurfaceArea() {
            return 2 * Math.PI * radius * (radius + height);
        }
    }

    // Inner class to represent a parallelogram
    public class Parallelogram {
        private double base;
        private double height;

        // Constructor to initialize the base and height of the parallelogram
        public Parallelogram(double base, double height) {
            this.base = base;
            this.height = height;
        }

        // Method to calculate the area of the parallelogram
        public double calculateArea() {
            return base * height;
        }
    }

    // Inner class to represent a trapezium
    public class Trapezium {
        private double base1;
        private double base2;
        private double height;

        // Constructor to initialize the two bases and height of the trapezium
        public Trapezium(double base1, double base2, double height) {
            this.base1 = base1;
            this.base2 = base2;
            this.height = height;
        }

        // Method to calculate the area of the trapezium
        public double calculateArea() {
            return (base1 + base2) * height / 2;
        }
    }
    
    // Inner class to represent a triangle
    public class Triangle {
        private double base;
        private double height;

        // Constructor to initialize the base and height of the triangle
        public Triangle(double base, double height) {
            this.base = base;
            this.height = height;
        }

        // Method to calculate the area of the triangle
        public double calculateArea() {
            return 0.5 * base * height;
        }
    }
    
    // Inner class for basic statistics calculations
    public class BasicStats {

    	// Method to calculate mean of an array of numbers
    	public static double calculateMean(double[] numbers) {
    		double sum = 0;

    		for (double number : numbers) {
    			sum += number;
    		}

    		return sum / numbers.length;
    	}

    	// Method to calculate median of an array of numbers
    	public static double calculateMedian(double[] numbers) {
    		// Sort the array in ascending order
    		Arrays.sort(numbers);

    		int middleIndex = numbers.length / 2;

    		if (numbers.length % 2 == 0) {
    			// If the array length is even, calculate the average of the two middle numbers
    			return (numbers[middleIndex - 1] + numbers[middleIndex]) / 2.0;
    		} else {
    			// If the array length is odd, return the middle number
    			return numbers[middleIndex];
    		}
    	}

    	// Method to calculate standard deviation of an array of numbers
    	public static double calculateStandardDeviation(double[] numbers) {
    		double mean = calculateMean(numbers);
    		double sumOfSquaredDifferences = 0;

    		for (double number : numbers) {
    			double difference = number - mean;
    			sumOfSquaredDifferences += difference * difference;
    		}

    		return Math.sqrt(sumOfSquaredDifferences / numbers.length);
    	}

    	// Method to calculate mode of an array of numbers
    	public static double calculateMode(double[] numbers) {
    		Map<Double, Integer> countMap = new HashMap<>();
    		int maxCount = 0;
    		double mode = Double.NaN;

    		for (double number : numbers) {
    			int count = countMap.getOrDefault(number, 0) + 1;
    			countMap.put(number, count);

    			if (count > maxCount) {
    				maxCount = count;
    				mode = number;
    			}
    		}

    		if (maxCount <= 1) {
    			mode = Double.NaN; // Set mode to NaN if there is no mode
    		}

    		return mode;
    	}
    	
    	// Method to calculate variance of an array of numbers. The isSample parameter specifies whether data represents a sample or population.
    	public static double calculateVariance(double[] data, boolean isSample) {
    		double mean = calculateMean(data);
    		double sumOfSquaredDifferences = 0;
    		for (double number : data) {
    			double difference = number - mean;
    			sumOfSquaredDifferences += difference * difference;
    		}
    		double variance = 0;
    		if (isSample) { 
    			variance = sumOfSquaredDifferences / (data.length - 1);
    		} else { 
    			variance = sumOfSquaredDifferences / data.length; 
    		}
    		return variance; 
    	}
    }



	@Override
	public void actionPerformed(ActionEvent e) {
	    String areaText = ""; // declare the variable here
	    try {
	        if (e.getSource() == areaRectangleItem) {
	            // Code to calculate area of rectangle
	            String inputLength = JOptionPane.showInputDialog(frame, "Enter the length of the rectangle");
	            String inputWidth = JOptionPane.showInputDialog(frame, "Enter the width of the rectangle");
	            String inputPrecision = JOptionPane.showInputDialog(frame, "Enter the precision for the area (number of decimal places)");
	            if (inputLength != null && inputWidth != null && inputPrecision != null) {
	                double length = Double.parseDouble(inputLength);
	                double width = Double.parseDouble(inputWidth);
	                double area = length * width;
	                double precision = Double.parseDouble(inputPrecision);
	                String format = "%." + (int) precision + "f"; // construct the format string
	                areaText = String.format(format, area); // format the area with the given precision
	                JOptionPane.showMessageDialog(frame, "The area of the rectangle is " + areaText);
	            }
	        } else if (e.getSource() == areaCircleItem) {
	            // Code to calculate area of circle
	            String inputRadius = JOptionPane.showInputDialog(frame, "Enter the radius of the circle");
	            String inputPrecision = JOptionPane.showInputDialog(frame, "Enter the precision for the area (number of decimal places)");
	            if (inputRadius != null && inputPrecision != null) {
	                double radius = Double.parseDouble(inputRadius);
	                double area = Math.PI * radius * radius;
	                double precision = Double.parseDouble(inputPrecision);
	                String format = "%." + (int) precision + "f"; // construct the format string
	                areaText = String.format(format, area); // format the area with the given precision
	                JOptionPane.showMessageDialog(frame, "The area of the circle is " + areaText);
	            }
	        } else if (e.getSource() == areaTriangleItem) {
	            // Code to calculate area of triangle
	            String inputBase = JOptionPane.showInputDialog(frame, "Enter the base of the triangle");
	            String inputHeight = JOptionPane.showInputDialog(frame, "Enter the height of the triangle");
	            String inputPrecision = JOptionPane.showInputDialog(frame, "Enter the precision for the area (number of decimal places)");
	            if (inputBase != null && inputHeight != null && inputPrecision != null) {
	                double base = Double.parseDouble(inputBase);
	                double height = Double.parseDouble(inputHeight);
	                double area = 0.5 * base * height;
	                double precision = Double.parseDouble(inputPrecision);
	                String format = "%." + (int) precision + "f"; // construct the format string
	                areaText = String.format(format, area); // format the area with the given precision
	                JOptionPane.showMessageDialog(frame, "The area of the triangle is " + areaText);
	            }
	        } else if (e.getSource() == areaCylinderItem) {
	            // Code to calculate area of cylinder
	            String inputRadius = JOptionPane.showInputDialog(frame, "Enter the radius of the cylinder");
	            String inputHeight = JOptionPane.showInputDialog(frame, "Enter the height of the cylinder");
	            String inputPrecision = JOptionPane.showInputDialog(frame, "Enter the precision for the surface area (number of decimal places)");
	            if (inputRadius != null && inputHeight != null && inputPrecision != null) {
	                double radius = Double.parseDouble(inputRadius);
	                double height = Double.parseDouble(inputHeight);
	                double area = 2 * Math.PI * radius * height + 2 * Math.PI * radius * radius;
	                double precision = Double.parseDouble(inputPrecision);
	                String format = "%." + (int) precision + "f"; // construct the format string
	                areaText = String.format(format, area); // format the surface area with the given precision
	                JOptionPane.showMessageDialog(frame, "The surface area of the cylinder is " + areaText);
	            }
	        } else if (e.getSource() == areaConeItem) {
	            // Code to calculate surface area of cone
	            String inputRadius = JOptionPane.showInputDialog(frame, "Enter the radius of the cone");
	            String inputHeight = JOptionPane.showInputDialog(frame, "Enter the height of the cone");
	            String inputPrecision = JOptionPane.showInputDialog(frame, "Enter the precision for the surface area (number of decimal places)");
	            if (inputRadius != null && inputHeight != null && inputPrecision != null) {
	                double radius = Double.parseDouble(inputRadius);
	                double height = Double.parseDouble(inputHeight);
	                double slantHeight= Math.sqrt(height*height+radius*radius);
		            double area = Math.PI * radius * (radius + slantHeight);
	                double precision = Double.parseDouble(inputPrecision);
	                String format = "%." + (int) precision + "f"; // construct the format string
	                areaText = String.format(format, area); // format the surface area with the given precision
	                JOptionPane.showMessageDialog(frame, "The surface area of the cone is " + areaText);
	            }
	        } else if (e.getSource() == areaParallelogramItem) {
	            // Code to calculate area of parallelogram
	            String inputBase = JOptionPane.showInputDialog(frame, "Enter the base of the parallelogram");
	            String inputHeight = JOptionPane.showInputDialog(frame, "Enter the height of the parallelogram");
	            String inputPrecision = JOptionPane.showInputDialog(frame, "Enter the precision for the area (number of decimal places)");
	            if (inputBase != null && inputHeight != null && inputPrecision != null) {
	                double base = Double.parseDouble(inputBase);
	                double height = Double.parseDouble(inputHeight);
	                double area = base * height;
	                double precision = Double.parseDouble(inputPrecision);
	                String format = "%." + (int) precision + "f"; // construct the format string
	                areaText = String.format(format, area); // format the area with the given precision
	                JOptionPane.showMessageDialog(frame, "The area of the parallelogram is " + areaText);
	            }
	        } else if (e.getSource() == areaTrapeziumItem) {
	            // Code to calculate area of trapezium
	            String inputBase1 = JOptionPane.showInputDialog(frame, "Enter the length of base 1 of the trapezium");
	            String inputBase2 = JOptionPane.showInputDialog(frame, "Enter the length of base 2 of the trapezium");
	            String inputHeight = JOptionPane.showInputDialog(frame, "Enter the height of the trapezium");
	            String inputPrecision = JOptionPane.showInputDialog(frame, "Enter the precision for the area (number of decimal places)");
	            if (inputBase1 != null && inputBase2 != null && inputHeight != null && inputPrecision != null) {
	                double base1 = Double.parseDouble(inputBase1);
	                double base2 = Double.parseDouble(inputBase2);
	                double height = Double.parseDouble(inputHeight);
	                double area = 0.5 * (base1 + base2) * height;
	                double precision = Double.parseDouble(inputPrecision);
	                String format = "%." + (int) precision + "f"; // construct the format string
	                areaText = String.format(format, area); // format the area with the given precision
	                JOptionPane.showMessageDialog(frame, "The area of the trapezium is " + areaText);
	            }
	        }
	    } catch (NumberFormatException ex) {
	        JOptionPane.showMessageDialog(frame, "Invalid input. Please enter only numbers.", "Error", JOptionPane.ERROR_MESSAGE);
	    
        } if (e.getSource() == quadraticEquationItem) {
            try {
                // Code to solve quadratic equation
                String inputA = JOptionPane.showInputDialog(frame, "Enter the coefficient of x^2");
                String inputB = JOptionPane.showInputDialog(frame, "Enter the coefficient of x");
                String inputC = JOptionPane.showInputDialog(frame, "Enter the constant term");
                if (inputA != null && inputB != null && inputC != null) {
                    double a = Double.parseDouble(inputA);
                    double b = Double.parseDouble(inputB);
                    double c = Double.parseDouble(inputC);
                    double discriminant = b * b - 4 * a * c;
                    if (discriminant > 0) {
                        double root1 = (-b + Math.sqrt(discriminant)) / (2 * a);
                        double root2 = (-b - Math.sqrt(discriminant)) / (2 * a);
                        rootsText = "The roots of the quadratic equation are " + root1 + " and " + root2;
                        JOptionPane.showMessageDialog(frame, rootsText);
                    } else if (discriminant == 0) {
                        double root = -b / (2 * a);
                        rootsText = "The root of the quadratic equation is " + root;
                        JOptionPane.showMessageDialog(frame, rootsText);
                    } else {
                        rootsText = "The quadratic equation has no real roots";
                        JOptionPane.showMessageDialog(frame, rootsText);
                    }
                }
            } catch (NumberFormatException ex) {
                JOptionPane.showMessageDialog(frame, "Invalid input. Please enter only numbers.", "Error", JOptionPane.ERROR_MESSAGE);
            }
        }
        else if (e.getSource() == basicStatsItem) {
            try {
                // Code to calculate basic statistics
                String input = JOptionPane.showInputDialog(frame, "Enter comma-separated values");
                if (input != null) {
                    String[] values = input.split(",");
                    double[] data = new double[values.length];
                    double sum = 0.0;
                    for (int i = 0; i < values.length; i++) {
                        data[i] = Double.parseDouble(values[i]);
                        sum += data[i];
                    }
                    double mean = sum / data.length;
                    double variance = 0.0;
                    for (int i = 0; i < data.length; i++) {
                        variance += Math.pow(data[i] - mean, 2);
                    }

                    // Ask the user whether the data represents a sample or a population
                    String[] options = {"Sample", "Population"};
                    int choice = JOptionPane.showOptionDialog(frame, "Does the data represent a sample or a population?", "Data Type", JOptionPane.DEFAULT_OPTION, JOptionPane.QUESTION_MESSAGE, null, options, options[0]);

                    // Calculate the variance based on the user's choice
                    if (choice == 0) { // Sample
                        variance /= data.length - 1;
                    } else { // Population
                        variance /= data.length;
                    }

                    double stddev = Math.sqrt(variance);
                    Arrays.sort(data);

                    // Calculate median
                    double median;
                    if (data.length % 2 == 0) {
                        median = (data[data.length / 2 - 1] + data[data.length / 2]) / 2.0;
                    } else {
                        median = data[data.length / 2];
                    }

                 // Calculate mode
                    Map<Double, Integer> countMap = new HashMap<>();
                    int maxCount = 0;
                    double mode = Double.NaN;
                    for (double value : data) {
                        int count = countMap.getOrDefault(value, 0) + 1;
                        countMap.put(value, count);
                        if (count > maxCount) {
                            maxCount = count;
                            mode = value;
                        }
                    }

                    // Check if there is no mode
                    if (maxCount == 1) {
                        mode = Double.NaN;
                    }


                    // Display the results in a JOptionPane with a custom button
                    String message = "Mean: " + mean + "\nVariance: " + variance + "\nStandard Deviation: " + stddev + "\nMedian: " + median + "\nMode: " + mode;
                    String[] buttons = {"OK", "Calculate Again"};
                    int result = JOptionPane.showOptionDialog(frame, message, "Results", JOptionPane.DEFAULT_OPTION, JOptionPane.INFORMATION_MESSAGE, null, buttons, buttons[0]);

                    // If the user clicks the "Calculate Again" button, call actionPerformed again with the same event
                    if (result == 1) {
                        actionPerformed(e);
                    } 
                }
            } catch (NumberFormatException ex) {
                JOptionPane.showMessageDialog(frame, "Invalid input. Please enter only numbers separated by commas.", "Error", JOptionPane.ERROR_MESSAGE);
            }
        }


	}
// Code to open up the GUI Application
public static void main(String[] args) {
    new MainFrame();
     }
}









