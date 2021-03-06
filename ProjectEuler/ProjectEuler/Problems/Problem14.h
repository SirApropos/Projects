#pragma once
#include "../stdafx.h"
#include "problem.h"
#ifndef Problem14def
#define Problem14def
using namespace Problems;
namespace Problems{
	class Problem14 :
		public Problem
	{
	public:
		Problem14(void);
		~Problem14(void);
		__int64 run(void);
	private:
		int target;
		int * cache;
		int cacheSize;
		__int64 runSequence(__int64 pos);
	};
}
#endif