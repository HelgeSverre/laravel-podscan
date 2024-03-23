<?php

namespace HelgeSverre\Podscan\Requests\Alerts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * alerts.update
 *
 * Updates the settings of an alert.
 */
class AlertsUpdate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function resolveEndpoint(): string
    {
        return "/teams/{$this->team}/alerts/{$this->alert}";
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     * @param  string  $alertName  Name of the alert, mostly for reference in the UI and notification emails
     * @param  array  $promptFilters  A list of strings to scan for, with wildcard (`word*`), negation (`word NOT unwanted_word`), and phrase (`"word word"`) support
     *                                Has to be between 1 and 10 items.
     * @param  bool  $alertEnabled  Whether the alert should run or be paused. `true` or `false`.
     * @param  string  $notificationEmail  An email address to send a notification to when a new mention is found. Defaults to your account's email or the team's email if set.
     * @param  bool  $notificationSummaryEnabled  Whether to send a summary of the alert's mentions instead of one email per mention. `true` or `false`.
     * @param  mixed  $notificationSummaryFrequency  How often to send a summary of the alert's mentions. `daily`, `weekly`, or `monthly`.
     * @param  mixed  $webhookUrl  A URL to send a POST request to when a new mention is found. The request will contain a JSON object with the mention's details.
     * @param  mixed  $promptQuestion  The Yes/No question to ask the AI when a new mention is found. Only used if `prompt_question_enabled` is `true`.
     * @param  mixed  $restrictToCategoryIds  A comma-separated list of category IDs to restrict the alert to. If not set, the alert will scan all categories.
     * @param  mixed  $restrictToPodcastIds  A comma-separated list of podcast IDs to restrict the alert to. If not set, the alert will scan all podcasts.
     */
    public function __construct(
        protected string $team,
        protected string $alert,
        protected string $alertName,
        protected array $promptFilters,
        protected bool $alertEnabled,
        protected ?string $notificationEmail = null,
        protected ?bool $notificationSummaryEnabled = null,
        protected ?string $notificationSummaryFrequency = null,
        protected ?string $webhookUrl = null,
        protected ?string $promptQuestion = null,
        protected ?array $restrictToCategoryIds = null,
        protected ?array $restrictToPodcastIds = null,
    ) {
    }

    public function defaultBody(): array
    {
        return array_filter([
            'alert_name' => $this->alertName,
            'prompt_filters' => $this->promptFilters,
            'alert_enabled' => $this->alertEnabled,

            'notification_email' => $this->notificationEmail,
            'notification_summary_enabled' => $this->notificationSummaryEnabled,
            'notification_summary_frequency' => $this->notificationSummaryFrequency,

            'webhook_enabled' => $this->webhookUrl !== null,
            'webhook_url' => $this->webhookUrl,

            'prompt_question_enabled' => $this->promptQuestion !== null,
            'prompt_question' => $this->promptQuestion,

            'restrict_to_category_ids' => $this->restrictToCategoryIds != null ? implode(',', $this->restrictToCategoryIds) : null,
            'restrict_to_podcast_ids' => $this->restrictToPodcastIds != null ? implode(',', $this->restrictToPodcastIds) : null,
        ]);
    }
}
