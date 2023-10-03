package backup;

import static org.junit.Assert.*;


import org.junit.Test;

import backup.MainFrame.BasicStats;

public class MainFrameTest2 {
	


	@Test
    public void testMeanCalculation() {
        double[] numbers = { 2.5, 4.7, 6.3, 8.1, 9.4 };

        // Calculate the mean
        double mean = BasicStats.calculateMean(numbers);

        // Compare the calculated mean with the expected mean (e.g., 6.2)
        assertEquals(6.2, mean, 0.001); // Provide a delta value for floating-point comparisons
    }

    @Test
    public void testMedianCalculation() {
        double[] numbers = { 2.5, 4.7, 6.3, 8.1, 9.4 };

        // Calculate the median
        double median = BasicStats.calculateMedian(numbers);

        // Compare the calculated median with the expected median (e.g., 6.3)
        assertEquals(6.3, median, 0.001); // Provide a delta value for floating-point comparisons
    }

    @Test
    public void testStandardDeviationCalculation() {
        double[] numbers = { 2.5, 4.7, 6.3, 8.1, 9.4 };

        // Calculate the standard deviation
        double stdDeviation = BasicStats.calculateStandardDeviation(numbers);

        // Compare the calculated standard deviation with the expected standard deviation (e.g., 2.263)
        assertEquals(2.441, stdDeviation, 0.001); // Provide a delta value for floating-point comparisons
    }
    
    @Test
    public void testModeCalculation() {
        double[] numbers = { 2.5, 4.7, 6.3, 8.1, 9.4 };

        // Calculate the mode
        double mode = BasicStats.calculateMode(numbers);

        // Compare the calculated mode with the expected mode (e.g., NaN for no mode)
        assertTrue(Double.isNaN(mode));
    }
    
    @Test
    public void testVarianceCalculation() {
        double[] numbers = { 2.5, 4.7, 6.3, 8.1, 9.4 };
        double expectedVariance = 5.96;
        double actualVariance = BasicStats.calculateVariance(numbers, false);
        assertEquals(expectedVariance, actualVariance, 0.0001);
    }
}