#include "Problem.h"
#include "Problem1.h"
#include "Problem2.h"
#include "Problem3.h"
#include "Problem4.h"
#include "Problem5.h"
#include "Problem6.h"
#include "Problem7.h"
#include "Problem8.h"
#include "Problem9.h"
#include "Timer.h"
#include "stdafx.h"

using namespace Problems;
void runProblem(Problem * &problem){
	Timer * timer = &Timer();
	timer->start();
	int sol = problem->run();
	timer->stop();
	std::cout << problem->getName() << ": " << sol << " in " << timer->getTime() << " seconds." << std::endl;
}

void runProblems(List<Problem *> * problems){
	problems->foreach([&](Problem * problem){
		runProblem(problem);
		return NULL;
	});
}

void init(){
	List<Problem *> problems;
	/*problems.add(&Problem1());
	problems.add(&Problem2());
	problems.add(&Problem3());
	problems.add(&Problem4());
	problems.add(&Problem5());
	problems.add(&Problem6());
	problems.add(&Problem7());
	problems.add(&Problem8());*/
	problems.add(&Problem9());
	runProblems(&problems);
}

int main(){
	init();
	getchar();
	return EXIT_SUCCESS;
}


