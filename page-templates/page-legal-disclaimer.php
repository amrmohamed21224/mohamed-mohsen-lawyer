<?php
/**
 * Template Name: Legal Disclaimer Page
 *
 * @package MohamedMohsenLawyer
 */
get_header();

$office_name = st_l( 'مكتب المستشار محمد محسن للمحاماة', 'Mohamed Mohsen Law Firm' );

$sections = [
	[
		'title_ar' => 'لا استشارة قانونية',
		'title_en' => 'No legal advice',
		'body_ar'  => sprintf(
			'المحتوى المقدم من %s عبر هذا الموقع هو معلومات توعوية عامة فحسب، ولا يُعد في أي حال من الأحوال استشارة قانونية، ولا يجوز الاعتماد عليه كبديل عن الاستشارة القانونية المتخصصة في وضعك.',
			$office_name
		),
		'body_en'  => sprintf(
			'Content provided by %s on this website is general information only. It does not constitute legal advice and must not be relied upon as a substitute for professional counsel regarding your situation.',
			$office_name
		),
	],
	[
		'title_ar' => 'عدم ضمان النتائج',
		'title_en' => 'No guarantee of results',
		'body_ar'  => 'النتائج السابقة المذكورة في هذا الموقع (إن وُجدت) لا تضمن تحقيق النتيجة نفسها في أي قضية أخرى، لأن كل حالة تخضع لوقائعها ومستنداتها والإجراءات القانونية الخاصة بها.',
		'body_en'  => 'Past results mentioned on this site (if any) do not guarantee the same outcome in any other case. Every matter depends on its own facts, documents, and legal procedures.',
	],
	[
		'title_ar' => 'عدم نشوء علاقة محامٍ وموكل',
		'title_en' => 'No attorney-client relationship',
		'body_ar'  => 'إرسال طلب تواصل أو معلومات من خلال هذا الموقع لا يُنشئ بمفرده علاقة محامٍ وموكل، ولا يُعد قبولًا للقضية.',
		'body_en'  => 'Submitting a contact request or information through this website does not by itself create an attorney-client relationship or constitute case acceptance.',
	],
	[
		'title_ar' => 'دقة المعلومات',
		'title_en' => 'Accuracy of information',
		'body_ar'  => 'يسعى المكتب إلى دقة المعلومات القانونية المنشورة، إلا أن القوانين واللوائح عرضة للتغيير. يُنصح دائمًا بالتحقق من الوضع الراهن للقانون المنطبق على حالتك.',
		'body_en'  => 'The firm strives for accuracy in published legal information, but laws and regulations may change. Always verify the current legal position applicable to your case.',
	],
	[
		'title_ar' => 'المحتوى الخارجي',
		'title_en' => 'External content',
		'body_ar'  => 'لا يتحمل المكتب مسؤولية محتوى أي مواقع خارجية مرتبطة من هذا الموقع.',
		'body_en'  => 'The firm is not responsible for the content of any external websites linked from this site.',
	],
];
?>
<section class="st-page-hero">
	<div class="container">
		<?php get_template_part( 'template-parts/shared/breadcrumbs', null, [
			'items' => [ [ 'label_ar' => 'إخلاء المسؤولية القانوني', 'label_en' => 'Legal disclaimer', 'url' => null ] ],
		] ); ?>
		<h1 class="st-page-hero__title"><?php echo esc_html( st_l( 'إخلاء المسؤولية القانوني', 'Legal disclaimer' ) ); ?></h1>
	</div>
</section>

<section class="st-page-content legal-disclaimer-page">
	<div class="container legal-disclaimer-page__inner">

		<div class="legal-disclaimer-page__intro" role="note">
			<p><?php echo esc_html( st_l(
				'المعلومات الواردة في هذا الموقع هي معلومات عامة ولا تمثل استشارة قانونية لأي حالة محددة.',
				'Information on this website is general in nature and does not constitute legal advice for any specific case.'
			) ); ?></p>
		</div>

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				$wp_content = trim( get_the_content() );
				if ( $wp_content ) :
					?>
					<div class="legal-disclaimer-page__custom st-prose">
						<?php the_content(); ?>
					</div>
					<?php
				endif;
			endwhile;
		endif;
		?>

		<?php foreach ( $sections as $section ) : ?>
			<section class="legal-disclaimer-page__section" aria-labelledby="<?php echo esc_attr( sanitize_title( st_l( $section['title_ar'], $section['title_en'] ) ) ); ?>">
				<h2 id="<?php echo esc_attr( sanitize_title( st_l( $section['title_ar'], $section['title_en'] ) ) ); ?>" class="legal-disclaimer-page__heading">
					<?php echo esc_html( st_l( $section['title_ar'], $section['title_en'] ) ); ?>
				</h2>
				<p class="legal-disclaimer-page__text">
					<?php echo esc_html( st_l( $section['body_ar'], $section['body_en'] ) ); ?>
				</p>
			</section>
		<?php endforeach; ?>

		<div class="legal-disclaimer-page__footer">
			<a href="<?php echo esc_url( mml_lang_url( '' ) ); ?>" class="card__link">
				<?php echo esc_html( st_l( 'العودة للرئيسية', 'Back to homepage' ) ); ?> ←
			</a>
		</div>

	</div>
</section>
<?php get_footer(); ?>
