using FluentNHibernate.Mapping;
using lab_2.NHibernate.Data;

namespace lab_2.NHibernate.MappingData
{
    public class CurrenciesMap:ClassMap<Currencies>
    {
        public CurrenciesMap()
        {
            Id(x => x.Id).Column("id").GeneratedBy.Increment();
            Map(x => x.Code).Column("code");
            Map(x => x.Name).Column("name");
            Table("currencies");
        }
    }
}
