#include <iostream>
#include <string>
#include <fstream>
#include <stdio.h>
#include <stdlib.h>
#include <string>
#include <sstream>
#include <vector>

using namespace std;

class kCell {
	int type; //1: rule/ 2: blank/ 3: block
	string topValue;
	string bottomValue;
	int realValue;
	int downValue;
	int direction;
	int noOfCellsRight;
	int noOfCellsDown;
	
	public:
	int getType();
	string getTopValue();
	string getBottomValue();
	int getRealValue();
	int getDownValue();
	int getDirection();
	int getNoOfCellsRight();
	int getNoOfCellsDown();
	void setTopValue(string top);
	void setBottomValue(string bottom);
	void setType( int newType);
	void setRealValue(int setValue);
	void setDownValue(int setDown);
	void setDirection(int setDirection);
	void setNoOfCellsRight(int setNoOfCells);
	void setNoOfCellsDown(int setNoOfCells);
	void setIsRight();
	void setIsDown();
	void printTop();
	void printBottom();

	kCell(int setType, string setTop, string setBottom) {
	this->type = setType;
	this->topValue = setTop;
	this->bottomValue = setBottom;
	this->realValue = 0;
	this->downValue = 0;
	this->direction = 0;
	this->noOfCellsRight = 0;
	this->noOfCellsDown  = 0;
	}
};

int kCell::getType() {
	return this->type;
}

string kCell::getTopValue() {	
	if(this->type == 2) { 
		stringstream temp3;
		temp3 << this->realValue;		
		return (" " + temp3.str() + "  ");
	}	
	else
	return this->topValue;
}

string kCell::getBottomValue() {
	if(this->type == 2) { 
		stringstream temp3;
		temp3 << this->realValue;		
		return (" " + temp3.str() + "  ");
	}	
	else
	return this->bottomValue;
}

int kCell::getRealValue() {
	return this->realValue;
}

int kCell::getDownValue() {
	return this->downValue;
}

int kCell::getDirection() {
	return this->direction;
}

int kCell::getNoOfCellsRight() {
	return this->noOfCellsRight;
}

int kCell::getNoOfCellsDown() {
	return this->noOfCellsDown;
}
 	
void kCell::setType(int newType) {
	this->type = newType;
	if(newType == 2) {
		this->topValue = "    ";
		this->bottomValue = "    ";
	}
}

void kCell::setTopValue(string top) {

	if(top.size() == 1)
		this->topValue = "\\\\ " + top;	
	
	else
		this->topValue = "\\\\" + top;
}

void kCell::setBottomValue(string bottom) {

	if(bottom.size() == 1)
		this->bottomValue = bottom + " \\\\";	
	
	else
		this->bottomValue = bottom + "\\\\";
}

void kCell::setRealValue(int setValue) {
	this->realValue = setValue;
}

void kCell::setDownValue(int setDown) {
	this->downValue = setDown;
}

void kCell::setDirection(int setDirection) {
	this->direction = setDirection;
}

void kCell::setNoOfCellsRight(int setNoOfCells) {
	this->noOfCellsRight = setNoOfCells;
}

void kCell::setNoOfCellsDown(int setNoOfCells) {
	this->noOfCellsDown = setNoOfCells;
}

void kCell::printTop() {
	if(this->type == 2) { 
		stringstream temp3;
		temp3 << this->realValue;
		cout << (" " + temp3.str() + "  ");	
	}		
	else	

	cout << topValue;
}

void kCell::printBottom() {		
	cout << bottomValue;
}
