#include <iostream>
#include <fstream>
#include <stdio.h>
#include <stdlib.h>
#include <cstdlib>
#include <string>
#include <sstream>
#include <vector>
#include "kcell.h"
#include <random>
#include <algorithm>

using namespace std;


int cCount = 0, width = 0, height = 0, totalValue = 0, blanks, lines;

int endScore = 0;

vector<int> Rules;
vector< vector<int> > Ruleset(60,  vector<int>(5));
vector< vector<kCell> > kCellBoard;


// Gets the numbr of characters in the file
void getCharacters(ifstream& inFile) {
	char character; cCount = 0;
	while (inFile >> character) {++cCount;}
}

// Prints information about the board to the command line
void printBoardInfo(ifstream& inFile) {

	inFile.clear();
	inFile.seekg(0, ios::beg);

	inFile >> width;
	inFile >> height;
	inFile >> blanks;
	inFile >> lines;

	cout << "Count:" << cCount << endl;	
	cout << "Width: " << width << endl;
	cout << "Height: " << height << endl;
	cout << "Blanks: " << blanks << endl;
	cout << "Lines: " << lines << endl << endl;

}

// Copies each character from the file in Rules
void readFileToRules(ifstream& inFile) {
	Rules.reserve(cCount);
	for(int i = 0; i <= cCount; i++) {
		inFile >> Rules[i];
	}
}

// Copies each rule into a ruleset which contains each line from the original file
void copyRulesToRuleset() {
	
	int position = 0;
	
	for(int i = 0; i < lines; i++) {
		for(int j = 0;j <= 4; j++)
		{	
			Ruleset[i][j] = Rules[position++];
		}	
	}
}

// Used to prints the rules of the instance, for testing
void printRuleset() {

	cout << "D X Y V C\n";
	for(int i = 0;i < lines; i++) {
		for(int j = 0; j<=4;j++) {		
			cout << Ruleset[i][j];
			cout << " ";
		}
	cout << '\n';
	}

	cout << "\n\n\n";

}

// Sets the virtual board to all block cells for initialisation
void setBoardBlocks(){
	
	vector<kCell> cells;
	kCell cell(3, "####","####");

	for(int j = 0; j < width; j++) {
		cells.push_back(cell);		
	}

	for(int i = 0; i < height; i++) {
		kCellBoard.push_back(cells);	
	}
}

// Sets the cells of the board according to the instance provided
void setBoardCells(){
	
	int ruleDirection;
	int ruleX;
	int ruleY;
	string ruleValue;
	int ruleCells;

	string tempTop;
	string tempBottom;


	for(int i = 0; i < lines; i++) {	
		ruleDirection = Ruleset[i][0];
		ruleX = Ruleset[i][1] -1;
		ruleY = Ruleset[i][2] -1;
		int ruleValueInt = Ruleset[i][3];
		totalValue = totalValue + ruleValueInt;

		ruleCells = Ruleset[i][4];

			stringstream temp2;

			temp2 << ruleValueInt;		
			ruleValue = temp2.str();		
		
		
		tempTop = kCellBoard[ruleX][ruleY].getTopValue();
		tempBottom = kCellBoard[ruleX][ruleY].getBottomValue();

		kCellBoard[ruleX][ruleY].setType(1);

		if(ruleDirection == 1){
			kCellBoard[ruleX][ruleY].setNoOfCellsRight(ruleCells);
			kCellBoard[ruleX][ruleY].setTopValue(ruleValue);
			kCellBoard[ruleX][ruleY].setRealValue(ruleValueInt);
		
			if(tempBottom == "####") {
				kCellBoard[ruleX][ruleY].setBottomValue("  ");	}		
				 
			for (int j = 1; j <= ruleCells; j++) {
				kCellBoard[ruleX + j][ruleY].setType(2);
			}
		}
		else {
			kCellBoard[ruleX][ruleY].setNoOfCellsDown(ruleCells);			
			kCellBoard[ruleX][ruleY].setBottomValue(ruleValue);
			kCellBoard[ruleX][ruleY].setDownValue(ruleValueInt);			
			
			if(tempTop == "####") {
				kCellBoard[ruleX][ruleY].setTopValue("  "); 
			}

			for (int k = 1; k <= ruleCells; k++) {
				kCellBoard[ruleX][ruleY + k].setType(2);
			} 


		} // End of else

		} // End of kCellBoard for

}

// Sets the blank cells of the board to the given answer, from left to right
void setBlanks(string ansStr) {	

	vector<int> ansInt;
	
	for(int i = 0; i < blanks; i++) {
		ansInt.push_back(ansStr[i] - '0');
	}

	int bCount = 0;
	for(int i = 0; i < kCellBoard.size(); i++) {
		for(int j = 0; j < kCellBoard[0].size(); j++) {
			if(kCellBoard[j][i].getType() == 2) {
			        kCellBoard[j][i].setRealValue(ansInt[bCount]);
				bCount++;
			}
		}
	}


}

// Prints the entire board in a readable format, needs blanks set beforehand
void printKBoard() {

	int boardSize = kCellBoard.size()*kCellBoard[0].size();

	cout << " ";

	for (int i = 0; i < kCellBoard.size(); i++) {
		cout << "____";
	}

	cout << endl;


	for(int i = 0; i < kCellBoard.size(); i++) {
		cout << "|";
		for(int j = 0; j < kCellBoard[0].size(); j++) {
			kCellBoard[j][i].printTop();
		}
	
		cout << "|\n|";

		for(int j = 0; j < kCellBoard[0].size(); j++) {
			kCellBoard[j][i].printBottom();
		}
		
		cout << "|\n";
	

	}

	cout << " ";

	for (int i = 0; i < kCellBoard.size(); i++) {
		cout << "____";
	}

	cout << endl;

}

// Resets all values in the board back to zero
void resetCellValues() {
	for(int i = 0; i < kCellBoard.size(); i++) {
		for(int j = 0; j < kCellBoard[0].size(); j++) {
			kCellBoard[j][i].setRealValue(0);
		}
	}
}

// Sets the inherent values for each cell
void setRealValue(int width, int height, int setValue) {
	kCellBoard[width][height].setRealValue(setValue);
}

int calculateScore() {
	int current = totalValue;
	int tempVal = 0;
	int rCells = 0;
	int dCells = 0;
	int rTotal = 0;
	int dTotal = 0;


	for(int i = 0; i < kCellBoard.size(); i++) {
		
		for(int j = 0; j < kCellBoard[0].size(); j++) {
			
			if(kCellBoard[j][i].getType() == 1) {

				if(kCellBoard[j][i].getNoOfCellsRight() > 0) {
					rCells = kCellBoard[j][i].getRealValue();
					rTotal = 0;

					for(int m = 1; m <= kCellBoard[j][i].getNoOfCellsRight() ; m++) {
						rTotal += kCellBoard[j + m][i].getRealValue();
					}
					current = current + abs(rCells - rTotal);
					
				}
				
				if(kCellBoard[j][i].getNoOfCellsDown() > 0) {
					dCells = kCellBoard[j][i].getDownValue();
					dTotal = 0;

					for(int m = 1; m <= kCellBoard[j][i].getNoOfCellsDown(); m++) {
						dTotal += kCellBoard[j][i + m].getRealValue();
					}
					current = current + abs(dCells - dTotal);
					
				}
				
			}
		}	
	}	
	return current - totalValue;
}

// Prints the number of cells that each rule governs, for testing
void printNoOfCells() {
	for(int i = 0;i < kCellBoard.size();i++) {
		for(int j = 0; j < kCellBoard[0].size(); j++) {
			cout << kCellBoard[j][i].getNoOfCellsRight();
			cout << kCellBoard[j][i].getNoOfCellsDown();
		} 
	}
}

// Cointains the Genetic Algorithm for testing
void TestGA(string tempSol) {
	int limit = 10000;
	bool solved = false;
	int genScore = 10000, tempScore = 10000, bestScore = 1000;

	const string CHARACTERS = "123456789";

    random_device random_device;
    mt19937 generator(random_device());
    uniform_int_distribution<> distribution(0, CHARACTERS.size() - 1);

	string tempChar;
	string genSol = tempSol, bestSol = tempSol;
	int noImproved = 0;
	int gen, loc, c;

	for(gen = 0;(gen < limit) && !solved; gen++) {

		
		for(loc = 0;loc < blanks; loc++) {
			
			for(c = 0;c < 9; c++) {
				tempChar ="";
				tempChar = CHARACTERS[c];
				tempSol.replace(loc,1,tempChar);
				
				setBlanks(tempSol);
				tempScore = calculateScore();
				
				if(tempScore < genScore) {
					genSol = tempSol;
					genScore = tempScore;
					noImproved++;
				}
				

			}
			tempSol = bestSol;
		}

        tempSol = bestSol;
		if(bestScore == 0) {
			solved = true;
		}
		
    if ((gen % 5) == 0) {
        int repC = 0;
        tempSol = genSol;
        while(repC < 4){

            int randNum = rand()%(blanks);
            tempChar = CHARACTERS[distribution(generator)];
            tempSol.replace(randNum,1,tempChar);

            repC++;
        }
        setBlanks(genSol);
        tempScore = calculateScore();
        if(tempScore < bestScore) {
        bestSol = tempSol;
        bestScore = tempScore;}
    }
    if (gen % 500 == 0) {
                cout << gen << " Score: "<< genScore << " Sol: " << genSol << " No. Improved: " << noImproved << endl;
                bestSol = genSol;
                bestScore = genScore;
    }

	} // End of Gen Loop
	if(bestScore == 0)
	cout << endl << "SOLVED!";

	cout << endl << "Best Solution: " << bestSol;
	
	cout << endl << "Best Score: " << bestScore << endl;
	   setBlanks(bestSol);

}

// Contains the random algorithm for testing
string TestRandom(int limit) {
	cout << endl << "RandStart" << endl << endl;
	bool solved = false;

    const string CHARACTERS = "123456789";

    random_device random_device;
    mt19937 generator(random_device());
    uniform_int_distribution<> distribution(0, CHARACTERS.size() - 1);

    string posSol, bestSol = "";
	
	int iterator = 0, bestScore = 1000 ;
	vector<string> posSols;
	
	while( (iterator < limit)) {
		posSol = "";		
		for (int i = 0; i < blanks; i++) {
       			posSol += CHARACTERS[distribution(generator)];
		}		
		
		setBlanks(posSol);

		endScore = calculateScore();

		if(endScore < bestScore) {
			bestScore = endScore;
			bestSol = posSol;
		}

		if(endScore == 0) {
				solved = true;
				posSols.push_back(posSol);
		}
		if(iterator % 200000 == 0) {cout << endl << iterator;}
		iterator++;

	}

	cout << endl << "Best Score: " << bestScore << endl;
	cout << "Best Solution: " << bestSol << endl;
	unique(posSols.begin(),posSols.end()),posSols.end();

	if (posSols.size() > 0) {
		cout << endl << "No. of Possible Solutions: " << posSols.size() << endl;

		for(int n = 0; n < posSols.size(); n++) {
			cout << posSols[n] << endl;
		}
	}


    setBlanks(bestSol);
	return bestSol;
}

// The main, will run when the file is run
int main(int argc, char *argv[])
{	
        // Reads in the specified file
	ifstream inFile(argv[1]);
	if(!inFile) {
		cerr << "Unable to open file";
		exit(0);
	}
    string argument2 = argv[2];
	getCharacters(inFile);
	
	printBoardInfo(inFile);
	
	cout << "ReadFileToRules()" << endl;
	readFileToRules(inFile);
	cout << "CopyRulesToRuleset()" << endl;
	copyRulesToRuleset();
	cout << "SetBoardBlocks()" << endl;
	setBoardBlocks();	
	cout << "SetBoardCells()" << endl;
	setBoardCells();

	
///////////////////////////////////////////////////////
	
	// Testing Algorithms


	if(argument2 == "Random") {
           TestRandom(2000000);
           printKBoard();
    	}
	else if(argument2 == "GA") {
        const string CHARACTERS = "123456789";

        random_device random_device;
        mt19937 generator(random_device());
        uniform_int_distribution<> distribution(0, CHARACTERS.size() - 1);

        string randomSolution = "";
        for (int r = 0; r < blanks; r++) {
                        randomSolution += CHARACTERS[distribution(generator)];
        }
        TestGA(randomSolution);
        printKBoard();
	}
    else if(argument2 == "Both") {
        string bestRand = TestRandom(500000);
        TestGA(bestRand);
	}
	else {
	    cout << "Please enter Random, GA or Both after the name of the file.";
	}




} // End of main
//////////////////////////////////////////////////////////////





