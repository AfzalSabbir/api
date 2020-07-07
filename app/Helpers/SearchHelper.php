<?php
namespace App\Helpers;

class SearchHelper
{
  /**
  * Search Model
  */
  public static function search($model, $query=null, $join=null, $column=null)
  {
    select `users`.*, 

    // (case when first_name LIKE 'Sed neque labore%' then 300 else 0 end) + 

    (case when first_name LIKE 'Sed' || first_name LIKE 'neque' || first_name LIKE 'labore' then 150 else 0 end) +
    (case when first_name LIKE 'Sed%' || first_name LIKE 'neque%' || first_name LIKE 'labore%' then 50 else 0 end) + 
    (case when first_name LIKE '%Sed%' || first_name LIKE '%neque%' || first_name LIKE '%labore%' then 10 else 0 end) + 

    (case when last_name LIKE 'Sed' || last_name LIKE 'neque' || last_name LIKE 'labore' then 150 else 0 end) + 
    (case when last_name LIKE 'Sed%' || last_name LIKE 'neque%' || last_name LIKE 'labore%' then 50 else 0 end) +
    (case when last_name LIKE '%Sed%' || last_name LIKE '%neque%' || last_name LIKE '%labore%' then 10 else 0 end) + 

    (case when bio LIKE 'Sed' || bio LIKE 'neque' || bio LIKE 'labore' then 30 else 0 end) + 
    (case when bio LIKE 'Sed%' || bio LIKE 'neque%' || bio LIKE 'labore%' then 10 else 0 end) + 
    (case when bio LIKE '%Sed%' || bio LIKE '%neque%' || bio LIKE '%labore%' then 2 else 0 end) + 

    (case when email LIKE 'Sed' || email LIKE 'neque' || email LIKE 'labore' then 75 else 0 end) + 
    (case when email LIKE 'Sed%' || email LIKE 'neque%' || email LIKE 'labore%' then 25 else 0 end) + 
    (case when email LIKE '%Sed%' || email LIKE '%neque%' || email LIKE '%labore%' then 5 else 0 end) 

    as relevance 
    from `users` 
    group by `id` 

    order by `relevance` desc
  }

}
