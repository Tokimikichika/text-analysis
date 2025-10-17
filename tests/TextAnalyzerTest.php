<?php

namespace Tokimikichika\TextAnalysis\Tests;

use PHPUnit\Framework\TestCase;
use Tokimikichika\TextAnalysis\TextAnalyzer;

/**
 * Тестирует TextAnalyzer
 */
class TextAnalyzerTest extends TestCase
{
    /**
     * Тестирует подсчет слов
     */
    public function testCountWords(): void
    {
        $an = new TextAnalyzer();
        $this->assertSame(3, $an->countWords('a bb ccc'));
        $this->assertSame(0, $an->countWords('   '));
    }

    /**
     * Тестирует подсчет символов
     */
    public function testCountCharacters(): void
    {
        $an = new TextAnalyzer();
        $this->assertSame(4, $an->countCharacters('a bb c', true));
        $this->assertSame(6, $an->countCharacters('a bb c', false));
    }

    /**
     * Тестирует подсчет предложений
     */
    public function testCountSentences(): void
    {
        $an = new TextAnalyzer();
        $text = "Hello world.\n\nAnother paragraph!";
        $this->assertSame(2, $an->countSentences($text));
        $this->assertSame(1, $an->countSentences('One?'));
    }

    /**
     * Тестирует подсчет абзацев
     */
    public function testCountParagraphs(): void
    {
        $an = new TextAnalyzer();
        $text = "Hello world.\n\nAnother paragraph!";
        $this->assertSame(2, $an->countParagraphs($text));
        $this->assertSame(1, $an->countParagraphs("Single paragraph"));
    }
}


