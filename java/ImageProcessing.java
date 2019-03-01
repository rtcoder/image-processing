import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.*;

public class ImageProcessing {

	public static void main(String[] args) {
		try {
	    	File input = new File("../images/im3.jpeg");
	    	File input1 = new File("../images/im1.jpg");

	    	BufferedImage img = ImageIO.read(input);
	    	BufferedImage im1 = ImageIO.read(input1);
			
			int imgW = img.getWidth();
			int imgH = img.getHeight();

			System.out.println(imgW + " x " + imgH);
		} catch (Exception e) {}
	}
}