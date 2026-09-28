Mohamed Mohsen Lawyer — WordPress Custom Theme
==============================================

الوصف
------
ثيم WordPress مخصص لموقع المحامي محمد محسن. مبني بدون أي Page Builder.
يدعم اللغة العربية بشكل كامل مع بنية جاهزة للإنجليزية (غير مفعّلة حاليًا).

المتطلبات
----------
- PHP         : 8.0 أو أحدث
- WordPress   : 6.0 أو أحدث
- ACF Pro     : مطلوب (Advanced Custom Fields Pro — النسخة المدفوعة)

خطوات التفعيل (مرتّبة)
-----------------------
1. رفع مجلد الثيم إلى: /wp-content/themes/mohamed-mohsen-lawyer/
2. تفعيل إضافة ACF Pro من لوحة التحكم قبل تفعيل الثيم.
3. تفعيل الثيم من: المظهر ← الثيمات.
4. ** مهم ** الإعدادات ← الروابط الثابتة ← "حفظ التغييرات"
5. إنشاء الصفحات وربطها بالـ Template:
   - الصفحة الرئيسية ← Front Page
   - عن المكتب ← About Page
   - تواصل معنا ← Contact Page
   - شكرًا ← Thank You Page
   - إخلاء مسؤولية ← Legal Disclaimer Page
6. تهيئة "إعدادات الموقع" من ACF Options.
7. إنشاء قائمة التنقل وتعيينها على "القائمة الرئيسية".

ملاحظات تقنية
--------------
- حقول ACF في inc/acf-fields.php
- i18n عبر site_lang (ar/en)
- Form handler عبر AJAX
- Rate limiting: طلب واحد كل 60 ثانية لكل IP

الإصدار: 0.2.0
