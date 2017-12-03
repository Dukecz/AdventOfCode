/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package daytwo;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.StringTokenizer;

/**
 *
 * @author Duke
 */
public class DayTwo {

    /**
     * @param args the command line arguments
     * @throws java.io.IOException
     */
    public static void main(String[] args) throws IOException {
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        int length;
        int width;
        int height;
        int total = 0;
        int totalRibbon = 0;
        int lowest;
        int area1, area2, area3;
        int lowestRibbon;
        int secondLowestRibbon;

        do {
            StringTokenizer st = new StringTokenizer(br.readLine(), "x");

            try {
                length = Integer.parseInt(st.nextToken());
                lowestRibbon = length;
                
                width = Integer.parseInt(st.nextToken());
                if(width < lowestRibbon) {
                    secondLowestRibbon = lowestRibbon;
                    lowestRibbon = width;
                } else {
                    secondLowestRibbon = width;
                }
                
                height = Integer.parseInt(st.nextToken());
                if(height < lowestRibbon) {
                    secondLowestRibbon = lowestRibbon;
                    lowestRibbon = height;
                } else if(height < secondLowestRibbon) {
                    secondLowestRibbon = height;
                }
            } catch (java.util.NoSuchElementException e) {
                break;
            }

            area1 = 2 * length * width;
            lowest = area1;

            area2 = 2 * width * height;
            if (area2 < lowest) {
                lowest = area2;
            }

            area3 = 2 * height * length;
            if (area3 < lowest) {
                lowest = area3;
            }
            
            totalRibbon += lowestRibbon + lowestRibbon + secondLowestRibbon + secondLowestRibbon + width * height * length;
            lowest = lowest / 2;

            total += area1 + area2 + area3 + lowest;
        } while (true);
        
        System.out.println("Total paper: " + total);
        System.out.println("Total ribon: " + totalRibbon);
    }

}
