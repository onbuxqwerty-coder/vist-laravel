@props(['type' => 'organization'])

@if($type === 'organization')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "ТОВ фірма «ВІСТ»",
    "url": "https://vist.net.ua",
    "logo": "https://vist.net.ua/img/logo/vist_logo_w.png",
    "image": "https://vist.net.ua/img/logo/vist_logo_w.png",
    "description": "Постачання серверів, робочих станцій, промислових ПК та ДБЖ. Сервісний центр.",
    "telephone": "+380563700707",
    "email": "sales@vist.net.ua",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "вул. Князя Ярослава Мудрого, 27",
        "addressLocality": "Дніпро",
        "postalCode": "49000",
        "addressCountry": "UA",
        "addressRegion": "UA-12"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "48.4647",
        "longitude": "35.0462"
    },
    "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
        "opens": "09:00",
        "closes": "18:00"
    },
    "sameAs": []
}
</script>

@elseif($type === 'service')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "name": "Сервісний центр ТОВ фірма «ВІСТ»",
    "url": "https://vist.net.ua/service",
    "telephone": "+380952352312",
    "description": "Ремонт ноутбуків, ПК, ДБЖ та лазерних принтерів. Діагностика, гарантія на роботи.",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "вул. Князя Ярослава Мудрого, 27",
        "addressLocality": "Дніпро",
        "postalCode": "49000",
        "addressCountry": "UA"
    },
    "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Послуги сервісного центру",
        "itemListElement": [
            {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Ремонт ноутбуків та ПК"}},
            {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Обслуговування ДБЖ/UPS"}},
            {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Ремонт лазерних принтерів та БФП"}}
        ]
    }
}
</script>

@elseif($type === 'servers')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Серверне обладнання",
    "description": "Tower, Rack та Blade-сервери, NAS/SAN сховища від провідних виробників.",
    "brand": {"@type": "Brand", "name": "VIST"},
    "category": "Серверне обладнання",
    "offers": {
        "@type": "AggregateOffer",
        "priceCurrency": "UAH",
        "availability": "https://schema.org/InStock",
        "seller": {"@type": "Organization", "name": "ТОВ фірма «ВІСТ»"}
    }
}
</script>

@elseif($type === 'ipc')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Промислові ПК",
    "description": "Panel PC, Box PC, Rackmount-системи для промислової автоматизації. IP65/IP67, -40°C до +70°C.",
    "brand": {"@type": "Brand", "name": "VIST"},
    "category": "Промислові комп'ютери",
    "offers": {
        "@type": "AggregateOffer",
        "priceCurrency": "UAH",
        "availability": "https://schema.org/InStock",
        "seller": {"@type": "Organization", "name": "ТОВ фірма «ВІСТ»"}
    }
}
</script>
@endif
