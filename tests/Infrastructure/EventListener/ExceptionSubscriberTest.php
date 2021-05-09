<?php
namespace App\Tests\Infrastructure\EventListener;

use App\Infrastructure\EventListener\ExceptionSubscriber;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriberTest extends TestCase
{
    /** @test */
    public function should_return_array_with_subscribed_events(): void
    {
        $subscriber = new ExceptionSubscriber();
        $events = $subscriber::getSubscribedEvents();

        $this->assertArrayHasKey(KernelEvents::EXCEPTION, $events);
        $this->assertEquals('onKernelException', $events[KernelEvents::EXCEPTION]);
    }

    /** @test */
    public function should_return_void_if_not_instance_of_exception(): void
    {
        $exception = new BadRequestHttpException('message');
        $subscriber = new ExceptionSubscriber();
        $event = $this->createMock(ExceptionEvent::class);
        $event
            ->method('getThrowable')
            ->willReturn($exception);
        ;
        $subscriber->onKernelException($event);
    }
}