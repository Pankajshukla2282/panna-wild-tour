<?php

declare(strict_types=1);

namespace PWT\Bookings\Services;

defined('ABSPATH') || exit;

use PWT\Bookings\Repositories\BookingRepository;
use PWT\Bookings\Validators\BookingValidator;

final class BookingService
{
    public function __construct(
        private readonly BookingRepository $repository,
        private readonly BookingValidator $validator,
        private readonly EmailService $emailService
    ) {
    }

    /**
     * Create booking.
     */
    public function create(array $data): array
    {
        $data = wp_unslash($data);

        $validation = $this->validator->validate($data);

        if (!$validation['success']) {
            return $validation;
        }

        $bookingId = $this->repository->create($validation['data']);

        if (is_wp_error($bookingId)) {
            return [
                'success' => false,
                'message' => $bookingId->get_error_message(),
            ];
        }

        $this->emailService->sendAdminNotification(
            $bookingId,
            $validation['data']
        );

        $this->emailService->sendCustomerConfirmation(
            $bookingId,
            $validation['data']
        );

        do_action(
            'pwt/booking/created',
            $bookingId,
            $validation['data']
        );

        return [
            'success' => true,
            'booking_id' => $bookingId,
            'message' => __('Booking submitted successfully.', 'wildtours-plugin'),
        ];
    }
}