<?php

namespace App\DataFixtures;


use App\Entity\User;
use App\Entity\Comment;
use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('rina');
        $user->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'QqQ123'
        );
        $user->setPassword($hashedPassword);
        $user->setMail('iraledy@yandex.ru');
        $user->setPhone('89042896023');
        $user->setAvatar('https://pixelbox.ru/wp-content/uploads/2020/12/ava-twitch-32.jpg');
        $manager->persist($user);

        $news = new News();
        $news->setUser($user);
        $news->setTitle('Команда ЛГТУ — обладатель Кубка СФФ «Центр» по мини-футболу');
        $news->setDateAdded(new \DateTime('now'));
        $news->setAnnotation('Политеховцы одержали победы во всех матчах. Двух личных наград удостоены вратарь Иван Сапунов и бомбардир Глеб Подковыров.');
        $news->setNewsText('Соревнования проходили с 25 по 30 марта 2022 года в учебно-спортивном комплексе ЛГТУ. Липецкие студенты не оставили шанса соперникам из Орловского государственного университета (счет 7:1), липецкой команде «ЛАСК» (счет 14:6) и команде из воронежской области «Хлебороб» (счет 5:2). Одержав три победы, со 100% показателем парни завоевали золото. Второе место заняла команда «Хлебороб», третье «ЛАСК».

Отметим, что турнир входит в зачет Чемпионата Центрального федерального округа и Южного федерального округа в рамках зонального этапа Всероссийских соревнований по мини-футболу (футзалу) среди мужчин «Первая лига». Наша команда уже одерживала победу в Кубке Союза Федераций футбола «Центр» в 2020 году.

Поздравляем футболистов и тренера команды Алексея Панфилова!');
        $news->setPhoto('https://stu.lipetsk.ru/assets/components/gallery/connector.php?action=web/phpthumb&ctx=web&w=585&h=402&f=png&src=%2Fassets%2Fgallery%2F2601%2F6030.jpg');
        $news->setNumberOfViews(rand(0,100));
        $manager->persist($news);

        $user = new User();
        $user->setName('nonna1962');
        $user->setRoles(['ROLE_USER']);
        $user->setMail('nonna1962@gmail.com');
        $user->setPhone('89609780257');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '5cfc285f0'
        );
        $user->setPassword($hashedPassword);
        $user->setAvatar('https://cs4.pikabu.ru/post_img/2015/12/31/7/14515571875613781.jpg');
        $manager->persist($user);

        $news = new News();
        $news->setUser($user);
        $news->setTitle('Сильные идеи на благо страны');
        $news->setDateAdded(new \DateTime('now'));
        $news->setAnnotation('Сессии по генерации идей на Форум «Сильные идеи для третьего десятилетия» проходят в «Точке кипения» ЛГТУ с 11 по 22 апреля 2022 года.');
        $news->setNewsText('Модератором встреч выступает проректор по научной работе и инновациям ЛГТУ, общественный представитель Агентства стратегических инициатив в Липецкой области Сергей Евгеньевич Кузенков. Предложение Сергея Евгеньевича по развитию студенческих научных обществ вошло в ТОП-300 на форуме «Сильные идеи для нового времени» АСИ в 2020 году.

Первая встреча прошла 11 апреля со студентами-финалистами Акселератора стартапов ЛГТУ. Сергей Евгеньевич представил концепцию нового сезона всероссийского мероприятия, рассказал о нюансах регистрации и пригласил молодёжь к активному участию в проекте.

На второй встрече 13 апреля обсуждались социальные инициативы. Их предлагали студенты, преподаватели и активные жители региона. Участники презентовали свои идеи и получили обратную связь от экспертов и поддержку единомышленников.

На третьей сессии 15 апреля присутствовали заместитель главы Администрации Липецкой области Сергей Михайлович Курбатов и ректор ЛГТУ Павел Викторович Сараев. В зале «Интеграция» собрались представители крупного и малого бизнеса, сотрудники ЛГТУ. Обсуждение касалось предпринимательских и кадровых инициатив.

От университета уже подано более 50 идей. Отбор проектов продолжается до 22 апреля на крауд-платформе Агентства стратегических инициатив ideas.roscongress.org. Очередные сессии в «Точке кипения» пройдут 20 и 22 апреля.

Реализованы на федеральном и региональном уровнях будут 100 лучших идей. Самые удачные из них будут представлены Президенту России Владимиру Путину. Авторы самых интересных региональных проектов смогут отправиться на Петербуржский международный экономический форум в составе делегации Липецкой области.');
        $news->setNumberOfViews(rand(0,100));
        $news->setPhoto('https://stu.lipetsk.ru/assets/components/gallery/connector.php?action=web/phpthumb&ctx=web&w=588&h=392&f=png&src=%2Fassets%2Fgallery%2F2618%2F6073.jpg');
        $manager->persist($news);

        $user = new User();
        $user->setName('nataliya07031982');
        $user->setRoles(['ROLE_USER']);
        $user->setMail('nataliya07031982@gmail.com');
        $user->setPhone('85052427738');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '829275d8c'
        );
        $user->setPassword($hashedPassword);
        $user->setAvatar('https://masyamba.ru/Красивые-глаза-картинки/22-Eye-of-the-image.jpg');
        $manager->persist($user);


        $news = new News();
        $news->setUser($user);
        $news->setTitle('Первый весенний субботник');
        $news->setDateAdded(new \DateTime('now'));
        $news->setAnnotation('ЛГТУ присоединился к массовой акции проведения общегородских субботников.');
        $news->setNewsText('В уборках территорий активно приняли участие студенты, преподаватели, сотрудники и представители администрации университета. Работы проходили в течение прошлой недели и будут продолжаться на текущей неделе. Самой массовой стала уборка территории ЛГТУ 16 апреля 2022 года.

Субботник проводился на двух площадках – на территории кампуса по улице Московской, спортивных открытых площадках и территории у корпуса «Б» по улице Интернациональной. За три часа был проведен большой объем работы: собран мусор; побелены деревья; убраны сухая листва и ветки. Сотрудники экономического факультета приводили в порядок помещения Б-корпуса ЛГТУ.

Политеховцы убирались не только на территории вуза, но и активно включились в городские акции. Ребята вместе с представителями разных городских вузов расчистили амфитеатр Быханова сада, собрали 500 мешков мусора объемом 100 литров.

Коллектив ЛГТУ всегда поддерживал городские субботники, потому что чистота и порядок — залог не только здоровья, но и высокой экологической и бытовой культуры.');
        $news->setNumberOfViews(rand(0,100));
        $news->setPhoto('https://stu.lipetsk.ru/assets/components/gallery/connector.php?action=web/phpthumb&ctx=web&w=574&h=383&f=png&src=%2Fassets%2Fgallery%2F2619%2F6075.jpg');
        $manager->persist($news);

        $user = new User();
        $user->setName('georgiy1980');
        $user->setRoles(['ROLE_USER']);
        $user->setMail('georgiy1980@outlook.com');
        $user->setPhone('82929186225');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '9afe00e5c'
        );
        $user->setPassword($hashedPassword);
        $user->setAvatar('https://bugaga.ru/uploads/posts/2010-10/1288265298_3.jpg');
        $manager->persist($user);


        $comment = new Comment();
        $comment->setUser($user);
        $comment->setNews($news);
        $comment->setDateAdded(new \DateTime('now'));
        $comment->setCommentText('Кто вообще придумал эти субботники? И без них все нормально');
        $comment->setModerationStatus('отклонено');
        $manager->persist($comment);


        $news = new News();
        $news->setUser($user);
        $news->setTitle('Техническое творчество');
        $news->setDateAdded(new \DateTime('now'));
        $news->setAnnotation('По итогам XLIX Всероссийского конкурса научно-исследовательских, проектных и творческих работ магистрант ЛГТУ получила диплом победителя и именную медаль.');
        $news->setNewsText('Представители кафедры дизайна и художественной обработки материалов ЛГТУ приняли участие в конкурсе по направлению «Технологии и техническое творчество». Очная защита проектов состоялась  30 марта 2022 года в Москве в центре креативных индустрий ARTPLAY.

Магистрант Екатерина Ларских под научным руководством доцента Веры Анатольевны Кукушкиной защитила проект «Модернизация и создание проекта на основе реструктуризации детали путем оцифрования и преобразования методом 3D-моделирования». Цель работы – разработка возможности ремонта и модернизации оборудования при износе деталей или изменении технологического процесса. С привлечением современных технологий 3D-сканирования детали переводятся в цифровой вид, что позволяет модифицировать их в реалиях современного производства. На основе существующего литейного предприятия рассматривается концепция внедрения новой технологии производства литых деталей. Данная технология может заменить полный цикл производства, в случаях когда необходимо получить малый объем продукции с малыми затратами. При сложной конструкции детали значительно уменьшается объем требуемых работ, которые включают в себя создание литниковой системы, монтирования подмодельных плит, цикл формовки.');
        $news->setNumberOfViews(rand(0,100));
        $news->setPhoto('https://stu.lipetsk.ru/assets/components/gallery/connector.php?action=web/phpthumb&ctx=web&w=588&h=503&f=png&src=%2Fassets%2Fgallery%2F2616%2F6068.jpg');
        $manager->persist($news);

        $user = new User();
        $user->setName('polina19051961');
        $user->setRoles(['ROLE_USER']);
        $user->setMail('polina19051961@outlook.com');
        $user->setPhone('8042097502');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '5f4ca6649'
        );
        $user->setPassword($hashedPassword);
        $user->setAvatar('https://i.yapx.ru/PWwHk.jpg');
        $manager->persist($user);

        $comment = new Comment();
        $comment->setUser($user);
        $comment->setNews($news);
        $comment->setDateAdded(new \DateTime('now'));
        $comment->setCommentText('Ого! Не слышала о таком');
        $comment->setModerationStatus('обрабатывается');
        $manager->persist($comment);


        $news = new News();
        $news->setUser($user);
        $news->setTitle('Важно помнить!');
        $news->setDateAdded(new \DateTime('now'));
        $news->setAnnotation('Тематическая лекция прошла в ЛГТУ 18 апреля 2022 года в рамках Дня единых действий, в память о геноциде советского народа нацистами.');
        $news->setNewsText('Мероприятие призвано сохранить историческую правду о преступлениях нацистов и их пособников в отношении мирных советских граждан.  Встречу провела Елена Алексеевна Кольцова,  руководитель Липецкого регионального отделения «Поискового движения России», уполномоченный представитель Экспедиционного клуба «Неунываки». На мероприятии присутствовали проректор по учебно-воспитательной работе Ирина Павловна Полякова и помощник руководителя следственного управления, член рабочей группы проекта «Без срока давности» в Липецкой области Рогожников Евгений Петрович.

Елена Алексеевна рассказала о понятии «геноцид», о преступлениях фашистов в Липецкой области, отметила масштаб и характер преступлений нацистов, нацеленных против мирных жителей оккупированной территории. Свою лекцию спикер проиллюстрировала документальным фильмом «Воловская Хатынь», который описывает трагические события в первую оккупацию Воловского района.  Важно отметить, что действия Красной армии и единение советского народа в достижении Победы спасли наше государство и его граждан от полного уничтожения.

– Я считаю посещение таких мероприятий полезным, ведь это наша история и память о Великой Отечественной войне. Патриотическое воспитание в наше время необходимо для студентов. Важно знать и правильно оценивать как прошлые, так и настоящие события. Елена Кольцова, которая провела для нас эту лекцию, все четко и ясно рассказала, её действительно было интересно слушать, – поделилась впечатлениями студентка Софья Кулик.');
        $news->setNumberOfViews(rand(0,100));
        $news->setPhoto('https://stu.lipetsk.ru/assets/components/gallery/connector.php?action=web/phpthumb&ctx=web&w=574&h=383&f=png&src=%2Fassets%2Fgallery%2F2620%2F6079.jpg');
        $manager->persist($news);


        $user = new User();
        $user->setName('semen70');
        $user->setRoles(['ROLE_USER']);
        $user->setMail('semen70@yandex.ru');
        $user->setPhone('82765998281');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'ba26707ab'
        );
        $user->setPassword($hashedPassword);
        $user->setAvatar('https://pixelbox.ru/wp-content/uploads/2020/12/ava-vk-cats-92.jpg');
        $manager->persist($user);


        $comment = new Comment();
        $comment->setUser($user);
        $comment->setNews($news);
        $comment->setDateAdded(new \DateTime('now'));
        $comment->setCommentText('Это действительно вожно. Классное мероприятие');
        $comment->setModerationStatus('одобрено');
        $manager->persist($comment);


        $news = new News();
        $news->setUser($user);
        $news->setTitle('Мы вместе! Мы неравнодушны!');
        $news->setDateAdded(new \DateTime('now'));
        $news->setAnnotation('Активных участников Общероссийской акции взаимопомощи #МЫВМЕСТЕ наградили в Администрации Липецкой области.');
        $news->setNewsText('На торжественной церемонии награждения участников акции 15 апреля 2022 года глава региона Игорь Артамонов отметил важность добровольческой деятельности и поблагодарил участников акции за неравнодушие к чужим проблемам.

В числе награждённых несколько десятков человек. ЛГТУ в лице ректора Павла Викторовича Сараева был отмечен благодарственным письмом Администрации Липецкой области за вклад в развитие добровольчества на территории Липецкой области.

Студентам Антону Трубачеву, Александру Бизину и председателю профкома обучающихся ЛГТУ, руководителю Ассоциации студентов Липецкой области Сергею Александровичу Позднякову вручили благодарственные письма за активную гражданскую позицию и бескорыстный вклад в организацию акции.

В феврале добровольцы совместно с представителями региональной администрации и сотрудниками МЧС России по Липецкой области одними из первых встречали вынужденных переселенцев из Донецкой и Луганской народных республик. Сейчас волонтёры трудятся в центрах гуманитарной помощи, помогают в пунктах временного размещения.');
        $news->setNumberOfViews(rand(0,100));
        $news->setPhoto('https://stu.lipetsk.ru/assets/components/gallery/connector.php?action=web/phpthumb&ctx=web&w=588&h=420&f=png&src=%2Fassets%2Fgallery%2F2617%2F6069.jpg');
        $manager->persist($news);

        $manager->flush();
    }
}
