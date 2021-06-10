// MCOMP Computing Research Project
// David Jackson W17022414

const faces = document.querySelectorAll("input[type=checkbox][class=faceChk]");
if(faces.length !== 0) {
    for (let f = 0; f < 9; f++) {
        faces[f].addEventListener("change", function () {
            checkNoOfFaces(f.toString());
        });
    }
}
let intChecks = 0;
let submitButton = document.querySelector("input[name=submit]");
function checkNoOfFaces(faceNo) {

    if(faces[faceNo].checked) {
        if(intChecks <= 2) {
            if(intChecks === 2)
                submitButton.disabled = false;
            else
                submitButton.disabled = true;
            intChecks++;
            console.log("if" + intChecks);
        }
        else
            faces[faceNo].checked = false;
        console.log("ifelse" + intChecks);

    }
    else {
        intChecks--;
        submitButton.disabled = true;
        console.log("else" + intChecks);
    }
}


const patterns = document.querySelectorAll("input[type=checkbox][class=pattChk]");
const pattImages = document.querySelectorAll("img[class=pattImages]");
const pattLines = document.querySelectorAll("rect[class=lineSVG]");
const pattG = document.querySelectorAll("g[class=pattG]");

let order = [];

if(patterns.length !== 0) {
    for (let p = 0; p < 9; p++) {
        patterns[p].addEventListener("change", function () {
            addToOrder(p.toString());
        });
    }
}
function addToOrder(i) {
    if(patterns[i].checked) {
        updatePattern(i.toString(), 1);
    }
    else {
        updatePattern(i.toString(),0);
    }
}

const connections = [
        ["1","3","4"],
        ["0","2","3","4","5"],
        ["1","4","5"],
        ["0","1","4","6","7"],
        ["0","1","2","3","5","6","7","8"],
        ["1","2","4","7","8"],
        ["3","4","7"],
        ["3","4","5","6","8"],
        ["4","5","7"]
];


let finalPatternArray = new Array(9);
let finalPattern = "";
let latestNode = "9";
resetVariables();

function resetVariables() {
    finalPatternArray = [];
    for(let i = 0; i < 9; i++) {
        finalPatternArray[i] = [];
    }

    finalPattern = "";
    order = [];
    latestNode = "9";
}
document.getElementById("patternText").value = finalPatternArray;

document.getElementById("patternText").value = finalPatternArray;
document.getElementById("currentPattern").value = finalPattern;


function checkConnection(firstNode, secondNode) {
    let found = false;
    secondNode.toString();
    for(let i = 0; (i < connections[firstNode].length) && (found === false); i++) {
        if(connections[firstNode][i] === secondNode) {found = true;}
    }
    return found;
}

function updatePattern(currentImgNo , offORon) {
    let currentActionBox = document.getElementById("currentAction");

    if ((latestNode === "9") || (finalPattern[0] === currentImgNo && finalPattern[1] === undefined) ) { // Set the image as the start of the pattern
        if(offORon) {
            finalPattern = currentImgNo;
            latestNode = currentImgNo;

            currentActionBox.value = latestNode;
            console.log("Set image as start");
            pattImages[currentImgNo].src = "../images/Pattern_Checked.jpg";
        }
        else {
            resetVariables();
            currentActionBox.value = latestNode;
            console.log("Remove image as start");
            pattImages[currentImgNo].src = "../images/Pattern_Unchecked.jpg";
        }
    }
    else {
        if (offORon) { // Image has been turned on i.e (1)

            if (checkConnection(currentImgNo, latestNode) && checkConnection(latestNode, currentImgNo)) { // Checks that the image is close enough to be connected
                // MAKE CONNECTION //

                // Append the end of the pattern to the current image and vice-versa
                finalPatternArray[latestNode].splice(1,0,currentImgNo);
                finalPatternArray[currentImgNo].splice(0,0,latestNode);

                //checkDistance(latestNode, currentImgNo);
                let xHalf = pattImages[latestNode].width / 2;
                let yHalf = pattImages[latestNode].height / 2;
                let posX = (pattImages[latestNode].getBoundingClientRect().left) + scrollX + xHalf - 7;
                let posY = (pattImages[latestNode].getBoundingClientRect().top) + scrollY + yHalf - 7;

                transformLine(offORon, latestNode, currentImgNo, posX, posY);

                latestNode = currentImgNo;
                console.log("posX: " + posX + " posY:" + posY);

                // Connect current image to the end of the pattern
                finalPattern = finalPattern + currentImgNo;
                currentActionBox.value = latestNode;
                console.log("Make Connection");
                console.log(finalPattern);

                pattImages[currentImgNo].src = "../images/Pattern_Checked.jpg";
                document.getElementById("currentPattern").value = finalPattern;
                if(finalPattern.length >= 3) {
                    if(submitButton.disabled === true)
                        submitButton.disabled = false;
                }
            }
            else { // Image cannot be connected to the end pattern
                // Uncheck the image as it isn't allowed
                patterns[currentImgNo].checked = false;
                currentActionBox.value = latestNode;
                console.log("Image can't be connected");
            }
        }

        else { // Image has been turned off i.e (0)
            if (latestNode === currentImgNo) { // If image has one connection
                // REMOVE CONNECTION //

                // Remove the connection to the previous part of the pattern
                finalPattern = finalPattern.slice(0, -1);
                latestNode = finalPatternArray[latestNode][0];

                let xHalf = pattImages[latestNode].width / 2;
                let yHalf = pattImages[latestNode].height / 2;
                let posX = (pattImages[latestNode].getBoundingClientRect().left) + scrollX + xHalf - 5;
                let posY = (pattImages[latestNode].getBoundingClientRect().top) + scrollY + yHalf - 5;

                transformLine(offORon, latestNode, latestNode, posX, posY);

                // Remove this image from the end of the pattern
                finalPatternArray[latestNode].splice(1,1);
                finalPatternArray[currentImgNo].splice(0,1);

                currentActionBox.value = latestNode;
                console.log("Remove Connection");

                pattImages[currentImgNo].src = "../images/Pattern_Unchecked.jpg";
                document.getElementById("currentPattern").value = finalPattern;
                if(finalPattern.length <= 2) {
                    if(submitButton.disabled === false)
                        submitButton.disabled = true;
                }


            }
            else { // If image has two connections

                    // Turn image back on
                    patterns[currentImgNo].checked = true;

                    // Alert user that they can't select that image UNFINISHED
                    currentActionBox.value = latestNode;
                    console.log("Two Connections");
            }
        }
    }
    document.getElementById("currentPattern").value = finalPattern;
}


function moveLine(imgID, xOffset, yOffset, distance, rotation) {
    let transformMove = "translate(" + xOffset + "," + yOffset + ")";
    let transformRotate = "rotate(" + rotation + "deg)";

    console.log(transformMove);
    console.log(transformRotate);

    pattG[imgID].setAttribute('transform', transformMove);
    pattG[imgID].style.transform = "translate(" + xOffset + "," + yOffset + ")";

    pattLines[imgID].style.transform = "rotate(" + rotation + "deg)";
    pattLines[imgID].style.width = distance + "px";
}

function transformLine(offORon, firstImg, secondImg, xOffset, yOffset) {
    let v = checkDistance(firstImg, secondImg);
    let rotation = setRotation(firstImg,secondImg,v[1],v[2],v[3],v[4]);

    if(!offORon) {
        v[0] = 0;
        rotation = rotation - (2 * rotation);
    }

    moveLine(firstImg,xOffset,yOffset,v[0],rotation);
}

function checkDistance(firstImg, secondImg) {
    let x1 = pattImages[firstImg].getBoundingClientRect().x;
    let x2 = pattImages[secondImg].getBoundingClientRect().x;

    let y1 = pattImages[firstImg].getBoundingClientRect().y;
    let y2 = pattImages[secondImg].getBoundingClientRect().y;

    let distanceSquared = Math.pow(Math.abs(x1 - x2), 2) + Math.pow(Math.abs(y1 - y2), 2);
    let distance = Math.sqrt(distanceSquared);
    console.log(distance);
    return [distance,x1,x2,y1,y2];
}

function setRotation(firstImg, secondImg, x1, x2, y1, y2) {
    let rotation;

    if(x1 < x2) {
        if(y1 === y2)
            rotation = 0;
        else {
            if(y1 < y2)
                rotation = 45;
            else
                rotation = 315;
        }
    }
    else if(x1 > x2) {
        if(y1 === y2)
            rotation = 180;
        else {
            if(y1 < y2)
                rotation = 135;
            else
                rotation = 225;
        }
    }
    else {
        if(y1 < y2)
            rotation = 90;
        else
            rotation = 270;
    }
    return rotation;
}

