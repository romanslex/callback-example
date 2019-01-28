<?php

use App\Models\WidgetDefaultSettings;
use Illuminate\Database\Seeder;

class WidgetDefaultSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedWindows();
        $this->seedButtons();
        $this->seedMobileButtons();
        $this->seedMobileWindows();
    }

    private function seedWindows()
    {
        factory(WidgetDefaultSettings::class)->create([
            "type" => "window",
            "name" => "w1",
            "settings" => [
                "bgColor" => "rgba(0, 0, 0, 0.8)",
                "fontColor" => "rgba(255, 255, 255, 1)",
                "btnBgColor" => "rgba(0, 144, 199, 1)",
                "btnFontColor" => "rgba(255, 255, 255, 1)",

                "phrases" => [
                    "general" => [
                        "header" => "Здравствуйте!",
                        "text" => "Остались вопросы по ремонту? Оставьте ваш номер телефона, мы с Вами свяжемся и с радостью ответим на них.",
                        "btnText" => "Жду звонка!"
                    ],
                    "onExit" => [
                        "header" => "Здравствуйте!",
                        "text" => "Не нашли, что искали? Давайте мы вам перезвоним и ответим на все вопросы?",
                        "btnText" => "Жду звонка!"
                    ],
                    "afterSending" => [
                        "header" => "Спасибо за заявку, ожидайте звонка!",
                    ],
                    "notWorkingHours" => [
                        "header" => "Я вас категарически приветствую",
                        "text" => "Сейчас мы уже не работаем, но можем перезвонить вам завтра",
                        "btnText" => "Ага!"
                    ]
                ]
            ]
        ]);

        factory(WidgetDefaultSettings::class)->create([
            "type" => "window",
            "name" => "w2",
            "settings" => [
                "overlayColor" => "rgba(0, 0, 0, 0.4)",
                "btnBgColor" => "rgba(233,87,63,1)",
                "btnShadowColor" => "rgba(186, 45, 21, 1)",
                "phrases" => [
                    "general" => [
                        "header" => "Здравствуйте!",
                        "text" => "Остались вопросы по ремонту? Оставьте ваш номер телефона, мы с Вами свяжемся и с радостью ответим на них.",
                        "btnText" => "Жду звонка!"
                    ],
                    "onExit" => [
                        "header" => "Здравствуйте!",
                        "text" => "Не нашли, что искали? Давайте мы вам перезвоним и ответим на все вопросы?",
                        "btnText" => "Жду звонка!"
                    ],
                    "afterSending" => [
                        "header" => "Спасибо за заявку, ожидайте звонка!",
                    ],
                    "notWorkingHours" => [
                        "header" => "Я вас категарически приветствую",
                        "text" => "Сейчас мы уже не работаем, но можем перезвонить вам завтра",
                        "btnText" => "Ага!"
                    ]
                ]
            ]
        ]);

        factory(WidgetDefaultSettings::class)->create([
            "type" => "currentWindow",
            "name" => "w1"
        ]);
    }

    private function seedButtons()
    {
        factory(WidgetDefaultSettings::class)->create([
            "type" => "btn",
            "name" => "b1",
            "settings" => [
                "position" => "rb",
                "btnColor" => "rgba(33, 153, 255, 1)",
                "waveColor" => "rgba(33, 153, 255, 1)",
                "xPosition" => 20,
                "yPosition" => 20
            ]
        ]);

        factory(WidgetDefaultSettings::class)->create([
            "type" => "currentBtn",
            "name" => "b1"
        ]);
    }

    private function seedMobileButtons()
    {
        factory(WidgetDefaultSettings::class)->create([
            "type" => "mobileBtn",
            "name" => "mb1",
            "settings" => [
                "color" => "rgba(39, 132, 221, 0.95)",
                "xPosition" => 50,
                "yPosition" => 94
            ]
        ]);

        factory(WidgetDefaultSettings::class)->create([
            "type" => "currentMobileBtn",
            "name" => "mb1"
        ]);
    }

    private function seedMobileWindows()
    {
        factory(WidgetDefaultSettings::class)->create([
            "type" => "mobileWindow",
            "name" => "mw1",
            "settings" => [
                "bgColor" => "rgba(32, 95, 78, 0.95)",
                "fontColor" => "rgba(255,255,255,1)",
                "phrases" => [
                    "general" => [
                        "header" => "Мы Вам перезвоним!",
                        "btnText" => "Жду звонка!"
                    ],
                    "afterSending" => [
                        "header" => "Спасибо за заявку!"
                    ],
                    "notWorkingHours" => [
                        "header" => "Мы сейчас не работаем. Перезвоним завтра",
                        "btnText" => "Ok!"
                    ]
                ]
            ]
        ]);

        factory(WidgetDefaultSettings::class)->create([
            "type" => "currentMobileWindow",
            "name" => "mw1"
        ]);
    }
}
