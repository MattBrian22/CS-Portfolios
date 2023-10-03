package backup;

import static org.junit.Assert.assertEquals;

import java.awt.Rectangle;

import org.junit.Test;

import backup.MainFrame.Cone;
import backup.MainFrame.Cylinder;
import backup.MainFrame.Parallelogram;
import backup.MainFrame.Trapezium;
import backup.MainFrame.Triangle;

public class MainFrameTest {
	

    @Test
    public void testRectangleArea() {
        // Create a rectangle with width 5 and height 10
        Rectangle rectangle = new Rectangle(5, 10);

        // Calculate the area
        double area = rectangle.getWidth() * rectangle.getHeight();

        // Compare the calculated area with the expected area (e.g., 50)
        assertEquals(50, area, 0.001); // Provide a delta value for floating-point comparisons
    }

	@Test
    public void testConeSurfaceAreaCalculation() {
        MainFrame mainFrame = new MainFrame(); // Create an instance of MainFrame

        // Create a cone with radius 4 and height 6
        Cone cone = mainFrame.new Cone(4, 6);

        // Calculate the surface area
        double surfaceArea = cone.calculateSurfaceArea();

        // Compare the calculated surface area with the expected surface area (e.g., 150.796)
        assertEquals(140.882, surfaceArea, 0.001); // Provide a delta value for floating-point comparisons
    }

    @Test
    public void testCylinderSurfaceAreaCalculation() {
        MainFrame mainFrame = new MainFrame(); // Create an instance of MainFrame

        // Create a cylinder with radius 3 and height 8
        Cylinder cylinder = mainFrame.new Cylinder(3, 8);

        // Calculate the surface area
        double surfaceArea = cylinder.calculateSurfaceArea();

        // Compare the calculated surface area with the expected surface area (e.g., 225.724)
        assertEquals(207.345, surfaceArea, 0.001); // Provide a delta value for floating-point comparisons
    }

    @Test
    public void testParallelogramAreaCalculation() {
        MainFrame mainFrame = new MainFrame(); // Create an instance of MainFrame

        // Create a parallelogram with base 7 and height 9
        Parallelogram parallelogram = mainFrame.new Parallelogram(7, 9);

        // Calculate the area
        double area = parallelogram.calculateArea();

        // Compare the calculated area with the expected area (e.g., 63)
        assertEquals(63, area, 0.001); // Provide a delta value for floating-point comparisons
    }

    @Test
    public void testTrapeziumAreaCalculation() {
        MainFrame mainFrame = new MainFrame(); // Create an instance of MainFrame

        // Create a trapezium with base1 5, base2 9, and height 6
        Trapezium trapezium = mainFrame.new Trapezium(5, 9, 6);

        // Calculate the area
        double area = trapezium.calculateArea();

        // Compare the calculated area with the expected area (e.g., 42)
        assertEquals(42, area, 0.001); // Provide a delta value for floating-point comparisons
    }

    @Test
    public void testTriangleAreaCalculation() {
        MainFrame mainFrame = new MainFrame(); // Create an instance of MainFrame

        // Create a triangle with base 8 and height 5
        Triangle triangle = mainFrame.new Triangle(8, 5);

        // Calculate the area
        double area = triangle.calculateArea();

        // Compare the calculated area with the expected area (e.g., 20)
        assertEquals(20, area, 0.001); // Provide a delta value for floating-point comparisons
    }
}