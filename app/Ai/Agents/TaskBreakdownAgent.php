<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;
use Stringable;

// We define which AI service provider and model to use for this agent.
// Groq is the provider, and openai/gpt-oss-20b is the AI model name.
#[Provider(Lab::Groq)]
#[Model('openai/gpt-oss-20b')]
class TaskBreakdownAgent implements Agent, Conversational, HasStructuredOutput, HasTools
{
    // The Promptable trait allows this class to be run with a prompt directly, e.g. Agent::make()->prompt(...)
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     * These system instructions guide the AI on how to behave (e.g., act as a Project Manager).
     */
    public function instructions(): Stringable|string
    {
        return 'You are a senior software project manager. Your job is to break down a feature, use case, or idea into clear, actionable development tasks. Generate between 4 and 12 tasks, ordered logically (dependencies first). For each task, estimate how many days from now the task should be due (e.g. 1, 2, 5) and suggest a logical due time (e.g. "09:00", "17:00").';
    }

    /**
     * Get the list of messages comprising the conversation so far.
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     */
    public function tools(): iterable
    {
        return [];
    }

    /**
     * Get the agent's structured output schema definition.
     * This forces the AI to respond in a strict JSON format that matches this array schema.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            // The AI must return a key 'tasks' which contains an array of objects.
            'tasks' => $schema->array()->items(
                $schema->object([
                    'title' => $schema->string()->required(),
                    'description' => $schema->string()->required(),
                    'priority' => $schema->string()->enum(['high', 'medium', 'low'])->required(),
                    'days_from_now' => $schema->integer()->required(),
                    'due_time' => $schema->string()->required(),
                ])
            )->required(),
        ];
    }
}
