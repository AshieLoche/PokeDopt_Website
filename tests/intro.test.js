import { describe, test, it, expect } from "vitest";
import { calculateAverage, factorial, fizzBuzz, max } from "../src/intro";

describe('max', () => {
    it('should return the first argument if it is greater', () => {
        // Test Structure: AAA = Arrange, Act, Assert

        // Arrange: Set Up Test Environment including any necessary data or configurations (Ex. Turn on the TV)
        // const a = 2;
        // const b = 1;

        // Act: Perform the action we want to test (Ex. Press the power button)
        // const result = max(a, b);

        // Assert: Checks the outcome to ensure that it matches our expectations (Ex. Verify TV is off)
        // expect(result).toBe(2);

        // AAA Shortcut
        expect(max(2,1)).toBe(2);
    })

    it('should return the second argument if it is greater', () => {
        // AAA Shortcut
        expect(max(1,2)).toBe(2);
    })

    it('should return the first argument if arguments are equal', () => {
        // AAA Shortcut
        expect(max(1,1)).toBe(1);
    })
})

describe ('fizzBuzz', () => {
    it('should return FizzBuzz if arg is divisible by 3 and 5', () => {
        expect(fizzBuzz(15)).toBe('FizzBuzz');
    })

    it('should return Fizz if arg is only divisible by 3', () => {
        expect(fizzBuzz(9)).toBe('Fizz');
    })

    it('should return Buzz if arg is only divisible by 5', () => {
        expect(fizzBuzz(10)).toBe('Buzz');
    })

    it('should return arg as a string if it is not divisible by 3 or 5', () => {
        expect(fizzBuzz(7)).toBe('7');
    })
})

// Test-Driven Development (TDD): Test First, Code Later
describe ('calculateAverage', () => {
    it('should return NaN if given an empty array', () => {
        expect(calculateAverage([])).toBe(NaN);
    })

    it('should calculate the average of an array with a single element', () => {
        expect(calculateAverage([1])).toBe(1);
    })

    it('should calculate the average of an array with a two element', () => {
        expect(calculateAverage([1,2])).toBe(1.5);
    })

    it('should calculate the average of an array with a two element', () => {
        expect(calculateAverage([1,2,3])).toBe(2);
    })
})

// Exercise
describe('factorial', () => {
    it('should return 1 if given 0', () => {
        expect(factorial(0)).toBe(1);
    })

    it('should return 1 if given 1', () => {
        expect(factorial(1)).toBe(1);
    })

    it('should return 2 if given 2', () => {
        expect(factorial(2)).toBe(2);
    })

    it('should return 6 if given 3', () => {
        expect(factorial(3)).toBe(6);
    })

    it('should return 24 if given 4', () => {
        expect(factorial(4)).toBe(24);
    })

    it('should return undefined if given a negative number', () => {
        expect(factorial(-1)).toBeUndefined();
    })
})