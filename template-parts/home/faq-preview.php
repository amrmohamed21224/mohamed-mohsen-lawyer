<section class="section" aria-labelledby="faq-heading">
	<div class="container" style="max-width:48rem">
		<div class="section__header text-center">
			<span class="gold-rule mx-auto" aria-hidden="true" style="margin-inline:auto"></span>
			<p class="section-label"><?php echo esc_html( st_l( 'أسئلة شائعة', 'Frequently asked' ) ); ?></p>
			<h2 id="faq-heading" class="section__title"><?php echo esc_html( st_l( 'الأسئلة المتكررة', 'Frequently Asked Questions' ) ); ?></h2>
		</div>
<?php
$faqs = array_map( 'mml_map_faq_row', mml_get_faqs() );
if ( empty( $faqs ) ) {
	$faqs = [
		[
			'id'          => 1,
			'question_ar' => 'كيف يتم طلب استشارة أو التواصل مع المكتب؟',
			'question_en' => 'How to request a consultation or contact the firm?',
			'answer_ar'   => 'يمكنك التواصل عبر نموذج التواصل في هذا الموقع، أو عبر وسائل التواصل المعتمدة المدرجة في صفحة "تواصل معنا". سيقوم المكتب بمراجعة طلبك والرد عليك.',
			'answer_en'   => 'You can reach out through the contact form on this site, or via approved channels listed on the contact page.',
		],
		[
			'id'          => 2,
			'question_ar' => 'هل إرسال النموذج يعني قبول القضية؟',
			'question_en' => 'Does submitting the form mean case acceptance?',
			'answer_ar'   => 'لا. إرسال طلب تواصل أو معلومات من خلال الموقع لا يُنشئ بمفرده علاقة محامٍ وموكل، ولا يُعد قبولًا للقضية.',
			'answer_en'   => 'No. Contact requests do not create an attorney-client relationship or guarantee case acceptance.',
		],
		[
			'id'          => 3,
			'question_ar' => 'هل يمكن إرسال المستندات من خلال الموقع؟',
			'question_en' => 'Can documents be sent via the website?',
			'answer_ar'   => 'لا. لا يتوفر خيار رفع الملفات أو المستندات عبر هذا الموقع في الوقت الحالي. يرجى عدم إرسال أي مستندات حساسة عبر هذا النموذج.',
			'answer_en'   => 'No. File upload is not supported on this website. Please do not send sensitive documents via the form.',
		],
		[
			'id'          => 4,
			'question_ar' => 'ما المعلومات التي يجب تجنب إرسالها عبر النموذج؟',
			'question_en' => 'What information should be avoided in the form?',
			'answer_ar'   => 'يُرجى تجنب إرسال الأرقام القومية أو تفاصيل القضايا الحساسة أو البيانات المالية أو الوثائق الرسمية عبر نموذج التواصل.',
			'answer_en'   => 'Please avoid submitting national IDs, highly sensitive case details, or official documentation via the web form.',
		],
		[
			'id'          => 5,
			'question_ar' => 'هل تتوفر استشارة مجانية؟',
			'question_en' => 'Is a free consultation available?',
			'answer_ar'   => 'لا يُعلن المكتب عن استشارات مجانية في الوقت الحالي. يرجى التواصل للاستفسار عن التفاصيل.',
			'answer_en'   => 'The firm does not currently offer free consultations. Please get in touch for details.',
		],
	];
}
get_template_part( 'template-parts/shared/faq-accordion', null, [
	'faqs'            => $faqs,
	'instance_prefix' => 'home-faq',
] );
?>
	</div>
</section>
