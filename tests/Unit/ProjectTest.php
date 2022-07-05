<?php

namespace Tests\Unit;

use App\Http\Livewire\User\FeedbackForm;
use App\Http\Livewire\User\ServiceBookingForm;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Feedback;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function authorizeAdmin()
    {
        $this->post(route('auth.login'), [
            'email' => 'artemchiruhin@bk.ru',
            'password' => '12345'
        ]);
    }

    public function testNotAdminCanNotEnter()
    {
        $response = $this->get(route('admin.index'));
        $response->assertStatus(302);
    }

    public function testAdminCanEnter()
    {
        $this->authorizeAdmin();
        $response = $this->get(route('admin.index'));
        $response->assertOk();
    }

    public function testCanNotAuthorizeWithoutData()
    {
        $this->post(route('auth.login'), []);
        $this->assertFalse(auth()->check());
    }

    public function testCanAuthorizeWithData()
    {
        $this->post(route('auth.login'), ['email' => 'artemchiruhin@bk.ru', 'password' => '12345']);
        $this->assertTrue(auth()->check());
    }

    public function testCanNotRegisterWithoutData()
    {
        $this->post(route('auth.register'), []);
        $this->assertFalse(auth()->check());
    }

    public function testCanRegisterWithData()
    {
        $this->post(route('auth.register'), [
            'email' => Str::random(10) . '@mail.ru',
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'patronymic' => 'Иванович',
            'phone' => (string) rand(80000000000, 89999999999),
            'password' => '12345',
            'password_confirmation' => '12345'
        ]);
        $this->assertTrue(auth()->check());
    }

    public function testCanNotCreateCategoryWithoutData()
    {
        $this->authorizeAdmin();
        $response = $this->post(route('admin.service-categories.store'), []);
        $response->assertSessionHasErrors(['name']);
    }

    public function testCreateCategory()
    {
        $this->authorizeAdmin();
        $response = $this->post(route('admin.service-categories.store'), ['name' => Str::random(10)]);
        $response->assertSessionHas('categoryCreated', 'Категория успешно создана.');
    }

    public function testCanNotEditNotExistingCategory()
    {
        $this->authorizeAdmin();
        $response = $this->get(route('admin.service-categories.edit', 'not-existing-category'));
        $response->assertNotFound();
    }

    public function testDeleteCategory()
    {
        $this->authorizeAdmin();
        $category = ServiceCategory::orderBy('id', 'desc')->first();
        $response = $this->json('delete', route('admin.service-categories.destroy', $category), []);
        $response->assertSessionHas('categoryDeleted', 'Категория была удалена.');
    }

    public function testCanNotCreateServiceWithoutData()
    {
        $this->authorizeAdmin();
        $response = $this->post(route('admin.services.store'), []);
        $response->assertSessionHasErrors([
            'name',
            'description',
            'price',
            'service_category_id',
            'image'
        ]);
    }

    public function testCreateService()
    {
        $this->authorizeAdmin();
        $category = ServiceCategory::inRandomOrder()->limit(1)->first();
        Storage::fake('services');
        $response = $this->post(route('admin.services.store'), [
            'name' => Str::random(10),
            'description' => Str::random(50),
            'price' => rand(200, 999),
            'service_category_id' => $category->id,
            'image' => UploadedFile::fake()->image('image_one.jpg')
        ]);
        $response->assertSessionHas('serviceCreated', 'Услуга успшно создана.');
    }

    public function testCanNotEditNotExistingService()
    {
        $this->authorizeAdmin();
        $response = $this->get(route('admin.services.edit', 'not-existing-service'));
        $response->assertNotFound();
    }

    public function testDeleteService()
    {
        $this->authorizeAdmin();
        $service = Service::orderBy('id', 'desc')->first();
        $response = $this->json('delete', route('admin.services.destroy', $service), []);
        $response->assertSessionHas('serviceDeleted', 'Услуга была удалена.');
    }

    public function testCanNotCreateEmployeeWithoutData()
    {
        $this->authorizeAdmin();
        $response = $this->post(route('admin.employees.store'), []);
        $response->assertSessionHasErrors([
            'email',
            'first_name',
            'last_name',
            'patronymic',
            'phone',
            'service_category_id',
            'image',
            'started_at'
        ]);
    }

    public function testCreateEmployee()
    {
        $this->authorizeAdmin();
        $category = ServiceCategory::inRandomOrder()->limit(1)->first();
        Storage::fake('employees');
        $response = $this->post(route('admin.employees.store'), [
            'email' => Str::random(10) . '@mail.ru',
            'first_name' => 'Петр',
            'last_name' => 'Петров',
            'patronymic' => 'Петрович',
            'phone' => (string) rand(80000000000, 89999999999),
            'service_category_id' => $category->id,
            'image' => UploadedFile::fake()->image('image_one.jpg'),
            'started_at' => date('Y-m-d')
        ]);
        $response->assertSessionHas('employeeCreated', 'Сотрудник успешно добавлен.');
    }

    public function testCanNotEditNotExistingEmployee()
    {
        $this->authorizeAdmin();
        $response = $this->get(route('admin.employees.edit', 'not-existing-employee'));
        $response->assertNotFound();
    }

    public function testDeleteEmployee()
    {
        $this->authorizeAdmin();
        $employee = Employee::orderBy('id', 'desc')->first();
        $response = $this->json('delete', route('admin.employees.destroy', $employee), []);
        $response->assertSessionHas('employeeDeleted', 'Сотрудник был удалён.');
    }

    public function testDeleteBooking()
    {
        $this->authorizeAdmin();
        $booking = Booking::orderBy('id', 'desc')->first();
        $response = $this->json('delete', route('admin.bookings.destroy', $booking), []);
        $response->assertSessionHas('bookingDeleted', 'Запись была удалена.');
    }

    public function testCanNotMakeFeedbackWithoutData()
    {
        Livewire::test(FeedbackForm::class)
            ->set('name')
            ->set('service_id')
            ->set('rate')
            ->set('message')
            ->call('submit')
            ->assertHasErrors([
                'name' => 'required',
                'service_id' => 'required',
                'rate' => 'required',
                'message' => 'required'
            ]);
    }

    public function testMakeFeedback()
    {
        $service = Service::inRandomOrder()->limit(1)->first();
        Livewire::test(FeedbackForm::class)
            ->set('name', 'Артем')
            ->set('service_id', $service->id)
            ->set('rate', 4)
            ->set('message', 'Сообщение')
            ->call('submit');
        $this->assertTrue(Feedback::whereName('Артем')
            ->whereServiceId($service->id)
            ->whereRate(4)
            ->whereMessage('Сообщение')
            ->whereApproved(0)
            ->exists());
    }

    public function testApproveFeedback()
    {
        $this->authorizeAdmin();
        $feedback = Feedback::orderBy('id', 'desc')->first();
        $response = $this->json('put', route('admin.feedbacks.approve', $feedback), []);
        $response->assertSessionHas('feedbackApproved', 'Отзыв был одобрен.');
    }

    public function testDeleteFeedback()
    {
        $this->authorizeAdmin();
        $feedback = Feedback::orderBy('id', 'desc')->first();
        $response = $this->json('delete', route('admin.feedbacks.destroy', $feedback), []);
        $response->assertSessionHas('feedbackDeleted', 'Отзыв был удален.');
    }

    public function testCanNotShowNotExistingService()
    {
        $response = $this->get(route('user.services.show', 'not-existing-service'));
        $response->assertNotFound();
    }

    public function testCanNotEnterProfileWithoutAuth()
    {
        $response = $this->get(route('user.profile'));
        $response->assertRedirect(route('auth.login'));
    }
}
