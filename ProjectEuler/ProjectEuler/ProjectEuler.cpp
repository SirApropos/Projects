#include "ProblemList.h"
#include "Utils/Timer.h"
#include "stdafx.h"

using namespace Problems;
void runProblem(Problem * &problem){
	Timer * timer = &Timer();
	timer->start();
	__int64 sol = problem->run();
	timer->stop();
	std::cout << problem->getName() << ": " << sol << " in " << timer->getTime() << " seconds." << std::endl;
}

void runProblems(List<Problem *> * problems){
	problems->vforeach([&](Problem * problem){
		runProblem(problem);
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
	problems.add(&Problem8());
	problems.add(&Problem9());
	problems.add(&Problem10());
	problems.add(&Problem11());
	problems.add(&Problem12());
	problems.add(&Problem13());
	problems.add(&Problem14());
	problems.add(&Problem15());
	problems.add(&Problem16());
	problems.add(&Problem17());
	problems.add(&Problem18());
	problems.add(&Problem20());
	problems.add(&Problem67());
	*/
	problems.add(&Problem22());
	runProblems(&problems);
}

int main(){
	init();
	getchar();
	return EXIT_SUCCESS;
}


