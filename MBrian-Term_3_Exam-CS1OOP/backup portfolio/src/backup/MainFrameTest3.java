package backup;

import static org.junit.Assert.*;

import java.awt.event.ActionEvent;

import org.junit.Test;

public class MainFrameTest3 {

    @Test
    public void testQuadraticEquationCalculation() {
        // Set up any necessary input values
        MainFrame mainFrame = new MainFrame(); // Create an instance of MainFrame
        ActionEvent actionEvent = new ActionEvent(mainFrame.quadraticEquationItem, ActionEvent.ACTION_PERFORMED, "QuadraticEquation"); // Create a mock ActionEvent
        String expectedRoots = "The roots of the quadratic equation are 0.5 and -1.0";

        // Perform the action
        mainFrame.actionPerformed(actionEvent);

        // Get the actual result
        String actualRoots = mainFrame.getRootsText(); // Assuming getResultText() is a method in MainFrame that returns the roots text

        // Assert the expected result
        assertEquals(expectedRoots, actualRoots);
    }

    // Add more test methods as needed
}
