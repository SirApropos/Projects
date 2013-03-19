#pragma once
#include "problem.h"
#include "stdafx.h"

using namespace Problems;
namespace Problems{
	class EulerUtils
	{
	public:
		EulerUtils(void);
		static int findNextPrime(List<int> * &primes, __int64 target);
		static List<int> findFactors(__int64 target, List<int> * primes = &List<int>());
	};
}