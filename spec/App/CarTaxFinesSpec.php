<?php

namespace spec\App;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CarTaxFinesSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('App\CarTaxFines');
    }

    public function it_should_return_no_fine_if_petrol_not_expired()
    {
        $this->fine('petrol', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 10, date("Y"))))
             ->shouldReturn('£0.00');
    }

    public function it_should_return_fine_if_petrol_expired_by_1_week()
    {
        $this->fine('petrol', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 7, date("Y"))))
             ->shouldReturn('£500.00');
    }

    public function it_should_return_fine_if_petrol_expired_by_2_week()
    {
        $this->fine('petrol', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 14, date("Y"))))
             ->shouldReturn('£600.00');
    }

    public function it_should_return_fine_if_petrol_expired_by_4_week()
    {
        $this->fine('petrol', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 28, date("Y"))))
             ->shouldReturn('£864.00');
    }

    public function it_should_return_petrol_fine_that_should_not_exceed_2000()
    {
        $this->fine('petrol', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 84, date("Y"))))
             ->shouldReturn('£2000.00');
    }

    public function it_should_return_no_fine_if_diesel_not_expired()
    {
        $this->fine('diesel', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 10, date("Y"))))
             ->shouldReturn('£0.00');
    }

    public function it_should_return_fine_if_diesel_expired_by_1_week()
    {
        $this->fine('diesel', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 7, date("Y"))))
             ->shouldReturn('£500.00');
    }

    public function it_should_return_fine_if_diesel_expired_by_2_week()
    {
        $this->fine('diesel', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 14, date("Y"))))
             ->shouldReturn('£575.00');
    }

    public function it_should_return_fine_if_diesel_expired_by_4_week()
    {
        $this->fine('diesel', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 28, date("Y"))))
             ->shouldReturn('£760.44');
    }

    public function it_should_return_diesel_fine_that_should_not_exceed_2500()
    {
        $this->fine('diesel', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 112, date("Y"))))
             ->shouldReturn('£2500.00');
    }

    public function it_should_return_no_fine_if_motorbike_not_expired()
    {
        $this->fine('motorbike', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 10, date("Y"))))
             ->shouldReturn('£0.00');
    }

    public function it_should_return_fine_if_motorbike_expired_by_1_month()
    {
        $this->fine('motorbike', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"))))
             ->shouldReturn('£200.00');
    }

    public function it_should_return_fine_if_motorbike_expired_by_2_months()
    {
        $this->fine('motorbike', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 32, date("Y"))))
             ->shouldReturn('£400.00');
    }

    public function it_should_return_fine_if_motorbike_expired_by_3_months()
    {
        $this->fine('motorbike', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 63, date("Y"))))
             ->shouldReturn('£600.00');
    }

    public function it_should_return_fine_if_motorbike_expired_by_4_months()
    {
        $this->fine('motorbike', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 94, date("Y"))))
             ->shouldReturn('£800.00');
    }

    public function it_should_return_fine_if_motorbike_expired_by_5_months()
    {
        $this->fine('motorbike', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 125, date("Y"))))
             ->shouldReturn('£1000.00');
    }

    public function it_should_return_fine_if_motorbike_expired_by_6_months()
    {
        $this->fine('motorbike', date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 156, date("Y"))))
             ->shouldReturn('£1200.00');
    }

    public function it_should_send_you_to_jail_if_expired_is_over_6_months_and_petrol()
    {
        $this->shouldThrow('Exception')
             ->during(
                'fine',
                [
                    'petrol',
                    date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 187, date("Y")))
                ]
             );
    }

    public function it_should_send_you_to_jail_if_expired_is_over_6_months_and_diesel()
    {
        $this->shouldThrow('Exception')
             ->during(
                'fine',
                [
                    'diesel',
                    date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 187, date("Y")))
                ]
             );
    }

    public function it_should_send_you_to_jail_if_expired_is_over_6_months_and_motorbike()
    {
        $this->shouldThrow('Exception')
             ->during(
                'fine',
                [
                    'motorbike',
                    date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 187, date("Y")))
                ]
             );
    }
}
