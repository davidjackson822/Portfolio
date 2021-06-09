README

Keep in desktop or some non-removable media, cannot compile on removable media.

Compile with Ubuntu command line in the correct directory:
g++ ksim.cpp -o ksim

needs g++ compiler installed and up to date.

Run with ./ksim and then indicate the file path (instances/filename.txt, txt is required) as argument 1, and solver type (Random, GA and Both) as argument 2, similar to these examples:

./ksim instances/K2easy.txt Random
./ksim instances/Challenging3414.txt GA
./ksim instances/Expert4998.txt Both


