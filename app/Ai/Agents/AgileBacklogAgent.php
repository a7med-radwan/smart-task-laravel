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
class AgileBacklogAgent implements Agent, Conversational, HasStructuredOutput, HasTools
{
    // The Promptable trait allows this class to be run with a prompt directly, e.g. Agent::make()->prompt(...)
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     * These system instructions guide the AI to act as an Agile project manager.
     */
    public function instructions(): Stringable|string
    {
        return 'You are an experienced Agile project manager and Scrum Master. Your job is to create a realistic project title and sprint backlog for a software feature. Generate a descriptive project_title (e.g. "E-Commerce Book Store"), the requested number of sprints, with 3-5 user stories per sprint, ordered logically. For each user story, suggest a logical due_time (e.g. "17:00").';
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
     * This forces the AI to output the Agile backlog in a strict JSON format matching this array structure.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            // The AI must return a project title and an array of sprints.
            'project_title' => $schema->string()->required(),
            'sprints' => $schema->array()->items(
                $schema->object([
                    'name' => $schema->string()->required(),
                    'goal' => $schema->string()->required(),
                    'duration_weeks' => $schema->integer()->required(),
                    'stories' => $schema->array()->items(
                        $schema->object([
                            'title' => $schema->string()->required(),
                            'description' => $schema->string()->required(),
                            'priority' => $schema->string()->enum(['high', 'medium', 'low'])->required(),
                            'story_points' => $schema->integer()->enum([1, 2, 3, 5, 8])->required(),
                            'due_time' => $schema->string()->required(),
                            'tasks' => $schema->array()->items($schema->string())->required(),
                        ])
                    )->required(),
                ])
            )->required(),
        ];
    }
}
