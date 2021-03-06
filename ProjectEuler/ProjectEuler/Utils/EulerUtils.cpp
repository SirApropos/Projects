#include "EulerUtils.h"

List<BigInt *> * Problems::EulerUtils::factorialCache = new List<BigInt *>();

Problems::EulerUtils::EulerUtils(void)
{
}

BigInt& Problems::EulerUtils::factorial(int target){
	if(factorialCache->size() == 0){
		factorialCache->add(new BigInt(1));
	}
	for(int i=factorialCache->size();i<=target;i++){
		factorialCache->add(&(*factorialCache->last() * BigInt(i)));
	}
	return *factorialCache->last();
}

int Problems::EulerUtils::modularPow(__int64 base, __int64 exponent, __int64 modulus){
	__int64 result = 1;
	while(exponent > 0){
			if(exponent % 2 == 1){
				result = (result * base) % modulus;
			}
			exponent /= 2;
			base = (base*base) % modulus;
	}
	return (int)result;
}

bool Problems::EulerUtils::isPrime(__int64 num, int accuracy){
	bool result = false;
	if(num ==3 || num == 2){
		result = true;
	}else if(num % 2 ==0){
		result = false;
	}else{
		__int64 d = num-1;
		int s = 0;
		while(d % 2 == 0){
			d >>= 1;
			s++;
		}
		bool composite = false;
		for(int i=0;i<accuracy && !composite;i++){
			bool skip = false;
			__int64 r = (rand() % (num - 3)) + 2;
			int x = modularPow(r, d, num);
			if( x == 1 || x == num-1){
				continue;
			}
			for(int j=1;j<s;j++){
				x = (x*x) % num;
				if(x == 1){
					composite = true;
					break;
				}else if(x == num-1){
					skip = true;
					break;
				}
			}
			if(skip){
				continue;
			}
			composite = true;
		}
		result = (!composite);
	}
	return result;
}

int Problems::EulerUtils::findNextPrime(List<int> * &primes, __int64 target){
	if(primes->size() == 0){
		primes->add(2);
	}else{
 		for(int i=(primes->last() == 2) ? 3 : (primes->last() + 2);i<=target || target == -1;i+=2){
			if(isPrime(i)){
				primes->add(i);
				break;
			}
		}
	}
	return primes->last();
}

List<int> Problems::EulerUtils::findFactors(__int64 target, List<int> * primes){
	if(primes->size() == 0){
		findNextPrime(primes, target);
	}
	List<int> result = List<int>();
	__int64 remainder = target;
	if(primes->size() > 1){
		primes->foreach([&](int prime){
			while(remainder % prime == 0){
				remainder /= prime;
				result.add(prime);
			}
			return remainder == 0;
		});
	}
	if(remainder > 1){
		while(primes->last() < remainder){
			int prime = primes->last();
			if(remainder % prime == 0){
				remainder /= prime;
				result.add(prime);
			}else{
				findNextPrime(primes, target);
			}
		}
		result.add((int)remainder);
	}
	return result;
}

List<std::string *> Problems::EulerUtils::readFile(std::string filename){
	List<std::string *> result = List<std::string *>();
	return readFile(filename, result);
}

List<std::string *> Problems::EulerUtils::readFile(std::string filename, List<std::string *>& list){
	std::ifstream file(filename);
	if (file.is_open())
	{
		while(file.good()){
			std::string line;
			std::getline(file,line);
			list.add(new std::string(line));
		}
		file.close();
	}else{
		println("Could not open file.");
	}
	return list;
}

std::function<int(std::string, std::string)> Problems::EulerUtils::getStringComparator(void){
	return [&](std::string first, std::string second)->int{
		int maxLength = (first.length() > second.length()) ? second.length() : first.length();
		int result = 0;
		for(int i=0; i<maxLength && result == 0;i++){
			if(first[i] > second[i]){
				result = 1;
				break;
			}else if(first[i] < second[i]){
				result = -1;
				break;
			}
		}
		if(result == 0){
			if(first.length() > second.length()){
				result = 1;
			}else if(second.length() > first.length()){
				result = -1;
			}
		}
		return result;
	};
}

std::function<int(std::string *, std::string *)> Problems::EulerUtils::getStringPointerComparator(void){
	return [&](std::string * first, std::string * second)->int{
		return getStringComparator()(*first, *second);
	};
}