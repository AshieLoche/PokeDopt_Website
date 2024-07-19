// Lesson: Writing your first tests
export function max(a, b) {
    return (a > b) ? a : b;
}

// Exercise
export function fizzBuzz(n) {
    if (n % 3 == 0 && n % 5 == 0) return 'FizzBuzz';
    if (n % 3 == 0) return 'Fizz';
    if (n % 5 == 0) return 'Buzz';
    return  n.toString();
}

// Test-Driven Development (TDD): Test First, Code Later
export function calculateAverage(numbers) {
    if (numbers.length === 0) return NaN;
    const sum = numbers.reduce((sum, current) => sum + current, 0);
    return sum / numbers.length;
}

// Exercise
export function factorial(n) {
    // let result = 1;
    // for(let i = 1; i <= n; i++) {
    //     result *= i;
    // }
    // return result;
    if (n < 0) return undefined;
    if (n === 0) return 1;
    return n * factorial(n - 1);
}